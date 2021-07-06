<?php

namespace App\Services;

use App\Models\Account;
use App\Repositories\AccountRepository;

class AccountService
{
    protected $accountRepository;

    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function getOne(int $id): array
    {
        $account = $this->accountRepository->getOne($id);

        if (!$account) {
            return [
                'message' => 'Conta não encontrada'
            ];
        }

        return $account->toArray();
    }

    public function store(array $data): array
    {
        $account = $this->accountRepository->store($data);

        return [
            'message' => 'Conta criada com sucesso',
            'account' => [
                'bank' => $account['agency'] . ' | ' . $account['number'] . '-' . $account['digit'],
                'initial_balance' => $account['initial_balance']
            ]
        ];
    }

    public function update(array $data, int $id): array
    {
        $account = $this->accountRepository->update($data, $id);

        if (!$account) {
            return [
                'message' => 'Conta não atualizada'
            ];
        }

        return $account->toArray();
    }

    public function delete(int $id): array
    {
        $account = $this->accountRepository->delete($id);

        return [
            'message' => 'Conta excluída com sucesso',
            'usuário' => $account
        ];
    }

    
}