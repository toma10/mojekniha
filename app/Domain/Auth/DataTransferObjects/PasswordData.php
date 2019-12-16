<?php

namespace App\Domain\Auth\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class PasswordData extends DataTransferObject
{
    /** @var string */
    public $password;

    /** @var string */
    public $new_password;
}
