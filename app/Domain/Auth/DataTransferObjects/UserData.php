<?php

namespace App\Domain\Auth\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class UserData extends DataTransferObject
{
    public string $name;

    public string $username;

    public string $email;
}
