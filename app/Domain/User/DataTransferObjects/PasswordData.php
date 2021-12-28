<?php

namespace App\Domain\User\DataTransferObjects;

use App\Http\Requests\PasswordRequest;
use Spatie\DataTransferObject\DataTransferObject;

class PasswordData extends DataTransferObject
{
    public static function fromRequest(PasswordRequest $request): self
    {
        return new self($request->validated());
    }

    public string $password;

    public string $new_password;
}
