<?php

namespace App\Actions\User;

use App\Actions\Action;

class UpdateProfileAction extends Action
{
    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            'user.id' => ['integer','required'],
            'email' => ['email', 'max:255'],
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
