<?php

namespace App\Domain\User\Actions;

use App\Domain\User\DataTransferObjects\UpdateUserData;
use App\Domain\User\Models\User;

class UpdateUserAction
{
    public function execute(User $user, UpdateUserData $userData): User
    {
        return tap($user)->update($userData->all());
    }
}
