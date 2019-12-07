<?php

namespace App\Support;

class PasswordResetTokenGenerator
{
    const TOKEN_LENGTH = 128;

    public function generate()
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyz';

        return substr(str_shuffle(str_repeat($pool, self::TOKEN_LENGTH)), 0, self::TOKEN_LENGTH);
    }
}
