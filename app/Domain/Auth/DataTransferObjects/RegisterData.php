<?php

namespace App\Domain\Auth\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class RegisterData extends DataTransferObject
{
    public string $name;

    public string $username;

    public string $email;

    public string $password;

    public string $verify_email_url;
}
