<?php

namespace App\Actions\Auth;

class LogoutAction
{
    public function execute(): void
    {
        if (! auth()->check()) {
            return;
        }

        auth()->logout();
    }
}
