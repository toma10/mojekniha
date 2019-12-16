<?php

namespace App\Domain\Auth\Actions;

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
