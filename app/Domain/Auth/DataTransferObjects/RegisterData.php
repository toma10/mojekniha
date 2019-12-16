<?php

namespace App\Domain\Auth\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class RegisterData extends DataTransferObject
{
    /** @var string */
    public $name;

    /** @var string */
    public $username;

    /** @var string */
    public $email;

    /** @var string */
    public $password;

    /** @var string */
    public $verify_email_url;
}
