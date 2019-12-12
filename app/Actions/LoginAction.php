<?php

namespace App\Actions;

use App\DataTransferObjects\Auth\LoginData;
use Illuminate\Validation\ValidationException;

class LoginAction
{
    public function execute(LoginData $loginData): string
    {
        $token = auth()->attempt($loginData->all());

        if (! $token) {
            throw ValidationException::withMessages(
                ['email' => [trans('auth.failed')]]
            );
        }

        return $token;
    }
}
