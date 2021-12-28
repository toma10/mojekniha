<?php

namespace App\Http\Controllers\Api\Auth;

use App\Domain\Auth\Actions\RegisterAction;
use App\Domain\Auth\DataTransferObjects\RegisterData;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\TokenResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterController
{
    public function __invoke(RegisterRequest $request, RegisterAction $registerAction): JsonResource
    {
        $token = $registerAction->execute(RegisterData::fromRequest($request));

        return new TokenResource($token);
    }
}
