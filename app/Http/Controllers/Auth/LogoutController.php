<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\LogoutAction;
use Illuminate\Http\JsonResponse;

class LogoutController
{
    public function __invoke(LogoutAction $logoutAction): JsonResponse
    {
        $logoutAction->execute();

        return response()->json();
    }
}
