<?php

namespace App\Http\Controllers;

use App\Actions\User\CreateUserAction;
use App\Actions\User\LoginUserAction;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use ApiResponseTrait;

    private const TOKEN_NAME = 'API TOKEN';

    /**
     * @throws ValidationException
     */
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
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

    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
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

    public function logout(): \Illuminate\Http\JsonResponse
    {
        request()->user()->tokens()->delete();
        return $this->respondSuccess(message: "Logout successful!");
    }
}
