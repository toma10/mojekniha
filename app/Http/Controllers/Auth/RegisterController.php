<?php

namespace App\Http\Controllers\Auth;

use App\Domain\Auth\Actions\RegisterAction;
use App\Domain\Auth\DataTransferObjects\RegisterData;
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
