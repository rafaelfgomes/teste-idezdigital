<?php

namespace App\Services;

use App\Repositories\TransactionRepository;

class TransactionService
{
    protected $transactionRespository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRespository = $transactionRepository;
    }

    public function store(array $data): array
    {
        $transaction = $this->transactionRespository->store($data);

        $response = [
            'message' => 'Transação criada com sucesso',
            'transaction' => $transaction->toArray()
        ];

        return $response;
    }
}