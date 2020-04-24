<?php

namespace App\Domain\User\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class CreateUserData extends DataTransferObject
{
    public string $name;

    public string $username;

    public string $email;
}
