<?php

namespace App\Domain\Auth\DataTransferObjects;

use App\Http\Requests\Auth\ResetPasswordRequest;
use Spatie\DataTransferObject\DataTransferObject;

class ResetPasswordData extends DataTransferObject
{
    public static function fromRequest(ResetPasswordRequest $request): self
    {
        return new self($request->validated());
    }

    public string $email;

    public string $token;

    public string $password;
}
