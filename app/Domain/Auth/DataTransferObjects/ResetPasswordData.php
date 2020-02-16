<?php

namespace App\Domain\Auth\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class ResetPasswordData extends DataTransferObject
{
    public string $email;

    public string $token;

    public string $password;
}
