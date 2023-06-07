<?php

namespace App\Http\Controllers;

use App\Actions\User\CreateUserAction;
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
        $request->authenticate();
        $token = $request->user()->createToken(self::TOKEN_NAME)->plainTextToken;

        return $this->respondSuccess("Access token", 200, [
            'token' => $token
        ]);
    }

    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $token = CreateUserAction::run([
            'email' => $data['email'],
            'password' => $data['email']
        ]);

        return $this->respondSuccess("Access token", 200, [
            'token' => $token
        ]);
    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
        request()->user()->tokens()->delete();
        return $this->respondSuccess("Logout successful!");
    }
}
