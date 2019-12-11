<?php

namespace App\DataTransferObjects\Auth;

use Spatie\DataTransferObject\DataTransferObject;

class VerifyEmailData extends DataTransferObject
{
    /** @var int */
    public $id;

    /** @var string */
    public $hash;
}
