<?php

namespace App\Http\Controllers\Api\Auth;

use App\Domain\Auth\Actions\LoginApiAction;
use App\Domain\Auth\DataTransferObjects\LoginData;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\TokenResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginController
{
    public function __invoke(LoginRequest $request, LoginApiAction $loginAction): JsonResource
    {
        $token = $loginAction->execute(
            new LoginData($request->validated())
        );

        return new TokenResource($token);
    }
}
