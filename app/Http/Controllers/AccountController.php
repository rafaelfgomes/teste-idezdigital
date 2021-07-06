<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\StoreRequest;
use App\Http\Requests\Account\UpdateRequest;
use App\Services\AccountService;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;

class AccountController extends Controller
{
    use ApiResponser;

    protected $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function getOne(int $id): JsonResponse
    {
        return $this->successResponse($this->accountService->getOne($id));
    }

    public function store(StoreRequest $request)
    {
        return $this->successResponse($this->accountService->store($request->all()));
    }

    public function update(UpdateRequest $request, int $id): JsonResponse
    {
        return $this->successResponse([]);
    }
}
