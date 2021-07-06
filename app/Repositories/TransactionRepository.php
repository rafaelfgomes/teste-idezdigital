<?php

namespace App\Repositories;

use App\Models\Transaction;

class TransactionRepository
{
    public function store(array $data): Transaction
    {
        return new Transaction();
    }
}