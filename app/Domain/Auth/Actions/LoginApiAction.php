<?php

namespace App\Domain\Auth\Actions;

use App\Domain\Auth\DataTransferObjects\LoginData;
use Illuminate\Validation\ValidationException;

class LoginApiAction
{
    public function execute(LoginData $loginData): string
    {
        $token = auth()->attempt(
            $loginData->only('email', 'password')->toArray()
        );

        if (! $token) {
            throw ValidationException::withMessages(
                ['email' => [trans('auth.failed')]]
            );
        }

        return $token;
    }
}
