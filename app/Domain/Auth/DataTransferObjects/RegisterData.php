<?php

namespace App\Domain\Auth\DataTransferObjects;

use App\Http\Requests\Auth\RegisterRequest;
use Spatie\DataTransferObject\DataTransferObject;

class RegisterData extends DataTransferObject
{
    public static function fromRequest(RegisterRequest $request): self
    {
        return new self($request->validated());
    }

    public string $name;

    public string $username;

    public string $email;

    public string $password;

    public string $verify_email_url;
}
