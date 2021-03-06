<?php

namespace App\Repositories;

use Error;
use ErrorException;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Account;
use App\Helpers\AccountHelper;
use App\Helpers\DocumentHelper;
use App\Models\CompanyAccountData;
use Illuminate\Support\Facades\DB;

class AccountRepository
{
    public function getOne(int $id): ?Account
    {
        $account = Account::where('id', $id)->with(['companyData', 'transactions'])->first();

        return $account;
    }

    public function store(array $data): Account
    {
        $user = User::where('email', $data['user'])->with('accounts')->first();

        $accounts = $user->accounts()->get()->toArray();

        foreach ($accounts as $account) {
            if (AccountHelper::typeExists($account, $data)) {
                throw new Error('Usuário já possui esse tipo de conta cadastrada');
            }

            if (AccountHelper::accountExists($account, $data)) {
                throw new Error('Esta conta já está criada e associada a um usuário');
            }
        }

        DB::beginTransaction();

        try {
            $accountData = [
                'uuid' => Uuid::uuid4(),
                'agency' => $data['agency'],
                'number' => $data['number'],
                'digit' => $data['digit'],
                'initial_balance' => 0,
                'current_balance' => 0,
                'user_id' => $user->id,
                'account_type_id' => $data['type']
            ];
    
            $accountCreated = Account::create($accountData);

            if ($data['type'] === 1) {
            
                $companyAccountData = [
                    'uuid' => Uuid::uuid4(),
                    'company_name' => $data['company']['company_name'],
                    'fantasy_name' => $data['company']['fantasy_name'],
                    'company_document' => DocumentHelper::sanitizeDocument($data['company']['company_document']),
                    'account_id' => $accountCreated->id
                ];
    
                CompanyAccountData::create($companyAccountData);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ErrorException($e->getMessage());
        }

        DB::commit();

        return $accountCreated->with('companyData')->first();
    }

    public function update(array $data, int $id): ?Account
    {
        $account = Account::where('id', $id)->first();

        $account->delete();

        $accountUpdated = $this->store($data);

        return $accountUpdated;
    }

    public function delete(int $id): Account
    {
        $account = Account::find($id);

        return $account->delete();
    }

    public function getCurrentBalance(int $id): float
    {
        $account = Account::find($id);
        
        return $account->balance;
    }
    
    public function checkIfAccountHasBalance(int $id, float $value): bool
    {
        $currentBalance = $this->getCurrentBalance($id);

        if ($currentBalance < $value) {
            return false;
        }

        return true;
    }
}