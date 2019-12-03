<?php

namespace App\DataTransferObjects\Auth;

use Spatie\DataTransferObject\DataTransferObject;

class LoginData extends DataTransferObject
{
    /** @var string */
    public $email;

    /** @var string */
    public $password;
}
