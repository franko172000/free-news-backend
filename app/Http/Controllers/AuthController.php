<?php

namespace App\Http\Controllers;

use App\Actions\User\CreateUserAction;
use App\Actions\User\LoginUserAction;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use ApiResponseTrait;

    private const TOKEN_NAME = 'API TOKEN';

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        $token = LoginUserAction::run([
            'email' => $data['email'],
            'password' => $data['password']
        ]);

        return $this->respondSuccess([
            'token' => $token
        ],"Access token");
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        $token = CreateUserAction::run([
            'email' => $data['email'],
            'name' => $data['name'],
            'password' => $data['password']
        ]);

        return $this->respondSuccess([
            'token' => $token
        ],"Access token");
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        request()->user()->tokens()->delete();
        return $this->respondSuccess(message: "Logout successful!");
    }
}
