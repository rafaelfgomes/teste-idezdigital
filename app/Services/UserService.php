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

        if (empty($users)) {
            return [
                'message' => 'Nenhum usuário encontrado'
            ];
        }

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

        return $user->toArray();
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

    public function store(array $data): array
    {
        $user = $this->userRepository->store($data);

        return [
            'message' => 'Usuário cadastrado com sucesso',
            'usuário' => $user
        ];
    }

    public function update(array $data, int $id)
    {
        $user = $this->userRepository->update($data, $id);

        return [
            'message' => 'Usuário atualizado com sucesso',
            'usuário' => $user
        ];
    }

    public function delete(int $id): array
    {
        $user = $this->userRepository->delete($id);

        return [
            'message' => 'Usuário excluído com sucesso',
            'usuário' => $user
        ];
    }
}