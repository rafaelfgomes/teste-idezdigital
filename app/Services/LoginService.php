<?php

namespace App\Services;

use App\Repositories\LoginRepository;

class LoginService
{
    protected $loginRepository;

    public function __construct(LoginRepository $loginRepository)
    {
        $this->loginRepository = $loginRepository;
    }

    public function login(array $credentials): ?string
    {
        return $this->loginRepository->login($credentials);
    }
}