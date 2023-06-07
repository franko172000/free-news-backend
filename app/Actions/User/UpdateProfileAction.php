<?php

namespace App\Actions\User;

use App\Business\Actions\Action;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UpdateProfileAction extends Action
{
    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            'user.id' => ['integer|required'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'name' => ['required', 'string'],
        ];
    }

    /**
     * @return int
     */
    public function execute(): int
    {
        return $this->data['user']->update([
            'name' => $this->data['name'],
            'email' => $this->data['email']
        ]);
    }
}
