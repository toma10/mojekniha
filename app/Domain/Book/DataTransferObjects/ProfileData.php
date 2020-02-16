<?php

namespace App\Domain\Book\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class ProfileData extends DataTransferObject
{
    public string $name;

    public string $username;
}
