<?php

namespace App\Http\Controllers\Auth;

use App\Actions\LoginAction;
use App\DataTransferObjects\Auth\LoginData;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\TokenResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginController
{
    public function __invoke(LoginRequest $request, LoginAction $loginAction): JsonResource
    {
        $token = $loginAction->execute(
            new LoginData($request->validated())
        );

        return new TokenResource($token);
    }
}
