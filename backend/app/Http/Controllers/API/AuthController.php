<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    use ApiResponse;

    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Register a new user
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $result = $this->authService->register($request->validated());

        return $this->success(
            $result,
            'User registered successfully.',
            201
        );
    }

    /**
     * Login user
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $result = $this->authService->login($request->validated());

        if (!$result) {
            return $this->error(
                'Invalid email or password.',
                null,
                401
            );
        }

        return $this->success(
            $result,
            'Login successful.'
        );
    }

    /**
     * Logout user
     */
    public function logout(): JsonResponse
    {
        $this->authService->logout();

        return $this->success(
            null,
            'Logout successful.'
        );
    }

    /**
     * Get authenticated user
     */
    public function me(): JsonResponse
    {
        $user = $this->authService->me();

        return $this->success(
            $user,
            'Authenticated user fetched successfully.'
        );
    }
}
