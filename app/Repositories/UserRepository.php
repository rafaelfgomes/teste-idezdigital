<?php

namespace App\Repositories;

use App\Helpers\DocumentHelper;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class UserRepository
{
    public function register(array $data): User
    {
        $user = User::create([
            'uuid' => Uuid::uuid4(),
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'document' => DocumentHelper::sanitizeDocument($data['document']),
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        return $user;
    }
}