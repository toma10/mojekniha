<?php

namespace App\Domain\Auth\Actions;

use App\Domain\Auth\DataTransferObjects\LoginData;
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
