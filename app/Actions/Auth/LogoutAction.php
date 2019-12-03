<?php

namespace App\Actions\Auth;

use Exception;

class LogoutAction
{
    public function execute():void
    {
        try {
            auth()->logout();
        } catch (Exception $e) {
            //
        }
    }
}
