<?php

namespace App\Domain\Auth\DataTransferObjects;

use App\Http\Requests\Auth\ResendEmailVerificationRequest;
use Spatie\DataTransferObject\DataTransferObject;

class ResendEmailVerificationData extends DataTransferObject
{
    public static function fromRequest(ResendEmailVerificationRequest $request): self
    {
        return new self($request->validated());
    }

    public string $verify_email_url;
}
