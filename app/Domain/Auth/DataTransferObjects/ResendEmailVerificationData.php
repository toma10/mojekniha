<?php

namespace App\Domain\Auth\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class ResendEmailVerificationData extends DataTransferObject
{
    /** @var string */
    public $verify_email_url;
}
