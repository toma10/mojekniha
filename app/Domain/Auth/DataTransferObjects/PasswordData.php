<?php

namespace App\Domain\Auth\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class PasswordData extends DataTransferObject
{
    public string $password;

    public string $new_password;
}
