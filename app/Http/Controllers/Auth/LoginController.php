<?php

namespace App\Http\Controllers\Auth;

use App\Actions\LoginAction;
use App\Http\Resources\TokenResource;
use App\Http\Requests\Auth\LoginRequest;
use App\DataTransferObjects\Auth\LoginData;

class LoginController
{
    public function __invoke(LoginRequest $request, LoginAction $loginAction)
    {
        $token = $loginAction->execute(
            new LoginData($request->validated())
        );

        return new TokenResource($token);
    }
}
