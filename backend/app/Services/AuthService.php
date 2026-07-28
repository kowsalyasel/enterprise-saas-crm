<?php

namespace App\Services;

use App\Interfaces\AuthRepositoryInterface;

class AuthService
{
    public function __construct(
        protected AuthRepositoryInterface $repository
    ) {}

    public function register(array $data)
    {
        return $this->repository->register($data);
    }

    public function login(array $credentials)
    {
        return $this->repository->login($credentials);
    }

    public function logout()
    {
        return $this->repository->logout();
    }

    public function me()
    {
        return $this->repository->me();
    }
}
