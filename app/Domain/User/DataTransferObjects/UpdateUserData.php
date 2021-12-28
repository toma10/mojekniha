<?php

namespace App\Domain\User\DataTransferObjects;

use App\Http\Requests\UpdateUserRequest;
use Spatie\DataTransferObject\DataTransferObject;

class UpdateUserData extends DataTransferObject
{
    public static function fromRequest(UpdateUserRequest $request): self
    {
        return new self($request->validated());
    }

    public string $name;

    public string $username;
}
