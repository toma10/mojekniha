<?php

namespace App\Domain\Auth\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class ResetPasswordData extends DataTransferObject
{
    /** @var string */
    public $email;

    /** @var string */
    public $token;

    /** @var string */
    public $password;
}
