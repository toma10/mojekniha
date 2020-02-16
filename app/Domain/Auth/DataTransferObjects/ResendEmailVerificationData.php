<?php

namespace App\Domain\Auth\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class ResendEmailVerificationData extends DataTransferObject
{
    public string $verify_email_url;
}
