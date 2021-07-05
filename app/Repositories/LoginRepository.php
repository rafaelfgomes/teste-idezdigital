<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginRepository
{
    public function login(array $credentials): ?string
    {
        if (!Auth::attempt($credentials)) {
            return null;
        }

        $user = User::where('email', $credentials['email'])->first();

        return $user->createToken('auth_token')->plainTextToken;
    }
}