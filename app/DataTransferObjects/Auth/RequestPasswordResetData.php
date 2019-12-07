<?php

namespace App\DataTransferObjects\Auth;

use Spatie\DataTransferObject\DataTransferObject;

class RequestPasswordResetData extends DataTransferObject
{
    /** @var string */
    public $email;

    /** @var string */
    public $reset_password_url;
}
