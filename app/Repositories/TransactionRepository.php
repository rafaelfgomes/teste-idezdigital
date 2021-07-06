<?php

namespace App\Repositories;

use Error;
use Ramsey\Uuid\Uuid;
use App\Models\Transaction;

class TransactionRepository
{
    public function store(array $data): Transaction
    {
        $value = $data['value'];

        if (intval($data['type']) != 2) {
            $accountHasBalance = (new AccountRepository())->checkIfAccountHasBalance($data['account'], $data['value']);

            if (!$accountHasBalance) {
                throw new Error('Saldo insuficiente');
            }

            $value = ($data['value'] * -1);
        }        

        $transactionData = [
            'uuid' => Uuid::uuid4(),
            'value' => $value,
            'transaction_type_id' => $data['type'],
            'account_id' => $data['account']
        ];

        $transactionCreated = Transaction::create($transactionData);

        return $transactionCreated;
    }
}