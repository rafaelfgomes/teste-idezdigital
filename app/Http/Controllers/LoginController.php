<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use App\Services\LoginService;
use App\Http\Requests\Login\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    use ApiResponser;

    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $token = $this->loginService->login($request->all());

        if (!$token) {
            $error = [
                'message' => 'Usuário ou senha inválidos'
            ];

            return $this->errorsResponse($error, Response::HTTP_UNAUTHORIZED);
        }

        $login = [
            'access_token' => $token,
            'token_type' => 'Bearer'
        ];

        return $this->successResponse($login);
    }
}
