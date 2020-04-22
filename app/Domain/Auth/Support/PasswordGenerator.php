<?php

namespace App\Domain\Auth\Support;

class PasswordGenerator
{
    protected const PASSWORD_LENGTH = 16;

    public function generate(): string
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyz';

        return substr(str_shuffle(str_repeat($pool, self::PASSWORD_LENGTH)), 0, self::PASSWORD_LENGTH);
    }
}
