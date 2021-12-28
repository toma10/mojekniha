<?php

namespace App\Domain\Auth\DataTransferObjects;

use App\Http\Requests\Auth\ForgotPasswordRequest;
use Spatie\DataTransferObject\DataTransferObject;

class RequestPasswordResetData extends DataTransferObject
{
    public static function fromRequest(ForgotPasswordRequest $request): self
    {
        return new self($request->only('email', 'reset_password_url'));
    }

    public string $email;

    public string $reset_password_url;
}
