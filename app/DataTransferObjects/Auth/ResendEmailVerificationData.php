<?php

namespace App\DataTransferObjects\Auth;

use Spatie\DataTransferObject\DataTransferObject;

class ResendEmailVerificationData extends DataTransferObject
{
    /** @var string */
    public $verify_email_url;
}
