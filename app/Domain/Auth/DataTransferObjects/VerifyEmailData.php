<?php

namespace App\Domain\Auth\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class VerifyEmailData extends DataTransferObject
{
    public int $id;

    public string $hash;
}
