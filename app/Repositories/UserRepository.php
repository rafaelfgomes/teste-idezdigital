<?php

namespace App\Repositories;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Helpers\DocumentHelper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    public function getAll(): Collection
    {
        return User::all();
    }

    public function getOne(int $id): User
    {
        $user = User::findOrFail($id);
        
        return $user;
    }

    public function getUsersByName(string $name): Collection
    {
        $users = User::where('first_name', 'LIKE', ucfirst($name) . '%')->get();
        
        return $users;
    }

    public function register(array $data): User
    {
        $userData = [
            'uuid' => Uuid::uuid4(),
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'document' => DocumentHelper::sanitizeDocument($data['document']),
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ];

        return User::create($userData);
    }
}