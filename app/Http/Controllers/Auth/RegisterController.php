<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\RegisterAction;
use App\DataTransferObjects\Auth\RegisterData;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\TokenResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterController
{
    public function __invoke(RegisterRequest $request, RegisterAction $registerAction): JsonResource
    {
        $token = $registerAction->execute(
            new RegisterData($request->validated())
        );

        return new TokenResource($token);
    }
}
