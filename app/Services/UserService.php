<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data): User
    {
        return $this->userRepository->register($data);
    }
}