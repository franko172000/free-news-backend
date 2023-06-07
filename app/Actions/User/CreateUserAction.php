<?php

namespace App\Actions\User;

use App\Business\Actions\Action;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CreateUserAction extends Action
{
    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', Rule::unique(\App\Models\User::class)],
            'name' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * @return string|null
     */
    public function execute(): string|null
    {
        $user = User::create([
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'password' => Hash::make($this->data['password'])
        ]);

        return $user->createToken('apiToken')->plainTextToken;
    }
}
