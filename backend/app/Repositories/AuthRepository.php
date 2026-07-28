<?php

namespace App\Repositories;

use App\Interfaces\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthRepository implements AuthRepositoryInterface
{
    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = JWTAuth::fromUser($user);

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function login(array $credentials)
    {
        if (!$token = auth()->attempt($credentials)) {
            return null;
        }

        return [
            'token' => $token,
            'user' => auth()->user(),
        ];
    }

    public function logout()
    {
        auth()->logout();

        return true;
    }

    public function me()
    {
        return auth()->user();
    }
}
