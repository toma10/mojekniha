<?php

namespace App\Domain\Auth\Actions;

class LogoutAction
{
    public function execute(string $guard = 'api'): void
    {
        if (! auth()->guard($guard)->check()) {
            return;
        }

        auth()->guard($guard)->logout();
    }
}
