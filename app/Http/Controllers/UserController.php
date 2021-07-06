<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use App\Services\UserService;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\FilterNameRequest;

class UserController extends Controller
{
    use ApiResponser;

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getAll(): JsonResponse
    {
        return $this->successResponse($this->userService->getAll());
    }

    public function getUsersByName(FilterNameRequest $request): JsonResponse
    {
        return $this->successResponse($this->userService->getUsersByName($request->input('name')));
    }

    public function getOne(int $id): JsonResponse
    {
        return $this->successResponse($this->userService->getOne($id));
    }

    public function store(StoreRequest $request): JsonResponse
    {
        return $this->successResponse($this->userService->store($request->all()), Response::HTTP_CREATED);
    }
    
    public function update(UpdateRequest $request, int $id): JsonResponse
    {
        return $this->successResponse($this->userService->update($request->all(), $id));
    }
}
