<?php

namespace App\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class ProfileData extends DataTransferObject
{
    /** @var @string */
    public $name;

    /** @var @string */
    public $username;
}
