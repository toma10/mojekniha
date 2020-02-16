<?php

namespace App\Domain\Auth\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class RequestPasswordResetData extends DataTransferObject
{
    public string $email;

    public string $reset_password_url;
}
