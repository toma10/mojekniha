<?php

namespace App\Models;

class PasswordReset extends BaseModel
{
    public const UPDATED_AT = null;

    public static function findByEmail(string $email): PasswordReset
    {
        return PasswordReset::where(['email' => $email])->firstOrFail();
    }
}
