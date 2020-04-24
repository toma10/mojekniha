<?php

namespace App\Domain\User\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class UpdateUserData extends DataTransferObject
{
    public string $name;

    public string $username;
}
