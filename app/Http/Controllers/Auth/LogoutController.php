<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\LogoutAction;

class LogoutController
{
    public function __invoke(LogoutAction $logoutAction)
    {
        $logoutAction->execute();

        return response()->json();
    }
}
