<?php

namespace App\Domain\Auth\DataTransferObjects;

use App\Http\Requests\Auth\VerifyEmailRequest;
use Spatie\DataTransferObject\DataTransferObject;

class VerifyEmailData extends DataTransferObject
{
    public static function fromRequest(VerifyEmailRequest $request): self
    {
        return new self($request->validated());
    }

    public int $id;

    public string $hash;
}
