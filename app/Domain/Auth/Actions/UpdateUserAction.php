<?php

namespace App\Domain\Auth\Actions;

use App\Domain\Auth\DataTransferObjects\UserData;
use App\Domain\Auth\Models\User;

class UpdateUserAction
{
    public function execute(User $user, UserData $userData): User
    {
        $user->update($userData->all());

        return $user;
    }
}
