<?php

namespace App\Services;

use App\Helpers\DocumentHelper;
use App\Repositories\UserRepository;

class UserService
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll(): array
    {
        $users = $this->userRepository->getAll()->toArray();

        return $users;
    }

    public function getOne(int $id): array
    {
        $user = $this->userRepository->getOne($id);

        if (empty($user)) {
            return [
                'message' => 'Usuário não encontrado'
            ];
        }

        return [
            'name' => $user['first_name'] . ' ' . $user['last_name'],
            'document' => DocumentHelper::formatToResponse($user['document']),
            'email' => $user['email']
        ];
    }

    public function getUsersByName(string $name): array
    {
        $users = $this->userRepository->getUsersByName($name)->toArray();

        if (empty($users)) {
            return [
                'message' => 'Nenhum usuário encontrado'
            ];
        }

        return $users;
    }

    public function register(array $data): array
    {
        $user = $this->userRepository->register($data);

        return [
            'message' => 'Usuário cadastrado com sucesso',
            'usuário' => [
                'name' => $user['first_name'] . ' ' . $user['last_name'],
                'document' => DocumentHelper::formatToResponse($user['document']),
                'email' => $user['email']
            ]
        ];
    }
}