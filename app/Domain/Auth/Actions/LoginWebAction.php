<?php

namespace App\Domain\Auth\Actions;

use App\Domain\Auth\DataTransferObjects\LoginData;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class LoginWebAction
{
    public function execute(LoginData $loginData): void
    {
        $authenticated = auth()->guard('web')->attempt(
            $loginData->only('email', 'password')->toArray(),
            $loginData->remember
        );

        if (! $authenticated) {
            throw ValidationException::withMessages(
                ['email' => [trans('auth.failed')]]
            );
        }

        $user = auth()->guard('web')->user();

        if (! $user || ! $user->isAdmin()) {
            auth()->guard('web')->logout();
            abort(Response::HTTP_FORBIDDEN);
        }
    }
}
