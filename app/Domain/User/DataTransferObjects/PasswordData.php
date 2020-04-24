<?php

namespace App\Domain\User\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class PasswordData extends DataTransferObject
{
    public string $password;

    public string $new_password;
}
