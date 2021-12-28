<?php

namespace App\Domain\User\DataTransferObjects;

use App\Http\Requests\CreateUserRequest;
use Spatie\DataTransferObject\DataTransferObject;

class CreateUserData extends DataTransferObject
{
    public static function fromRequest(CreateUserRequest $request): self
    {
        return new self($request->validated());
    }

    public string $name;

    public string $username;

    public string $email;
}
