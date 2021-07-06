<?php

namespace App\Repositories;

use App\Models\Transaction;
use Ramsey\Uuid\Uuid;

class TransactionRepository
{
    public function store(array $data): Transaction
    {
        $transactionData = [
            'uuid' => Uuid::uuid4(),
            'value' => $data['value'],
            'transaction_type_id' => $data['type'],
            'account_id' => $data['account']
        ];

        $transactionCreated = Transaction::create($transactionData);

        return $transactionCreated;
    }
}