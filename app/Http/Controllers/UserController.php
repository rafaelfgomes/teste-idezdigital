<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\User\StoreRequest;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $user = $this->userService->register($request->all());
        } catch (\Exception $e) {
            $error = [ 'error' => $e->getMessage(), 'code' => Response::HTTP_BAD_REQUEST ];
            return new JsonResponse($error, Response::HTTP_BAD_REQUEST);
        }

        $data = [
            'message' => 'Usuário cadastrado com sucesso',
            'user' => $user,
            'code' => Response::HTTP_CREATED,
            'redirect' => env('APP_URL') . 'api/login'
        ];

        return new JsonResponse($data, Response::HTTP_CREATED);
    }
}
