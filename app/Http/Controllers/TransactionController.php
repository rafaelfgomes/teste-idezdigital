<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Services\TransactionService;
use App\Http\Requests\Transaction\StoreRequest;

class TransactionController extends Controller
{
    use ApiResponser;

    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function store(StoreRequest $request): JsonResponse
    {
        return $this->successResponse($this->transactionService->store($request->all()), Response::HTTP_CREATED);
    }
}
