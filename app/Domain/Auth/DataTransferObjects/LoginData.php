<?php

namespace App\Domain\Auth\DataTransferObjects;

use App\Http\Requests\Auth\LoginRequest;
use Spatie\DataTransferObject\DataTransferObject;

class LoginData extends DataTransferObject
{
    public static function fromRequest(LoginRequest $request): self
    {
        return new self($request->validated());
    }

    public string $email;

    public string $password;

    public bool $remember = false;
}
