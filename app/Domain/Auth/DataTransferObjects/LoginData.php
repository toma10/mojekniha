<?php

namespace App\Domain\Auth\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class LoginData extends DataTransferObject
{
    /** @var string */
    public $email;

    /** @var string */
    public $password;
}
