<?php

namespace App\Domain\Auth\Models;

use App\Domain\Shared\Models\BaseModel;

class PasswordReset extends BaseModel
{
    public const UPDATED_AT = null;

    public static function findByEmail(string $email): PasswordReset
    {
        return PasswordReset::where(['email' => $email])->firstOrFail();
    }
}
