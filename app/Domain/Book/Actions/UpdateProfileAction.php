<?php

namespace App\Domain\Book\Actions;

use App\Domain\Auth\Models\User;
use App\Domain\Book\DataTransferObjects\ProfileData;

class UpdateProfileAction
{
    public function execute(User $user, ProfileData $profileData): User
    {
        return tap($user)->update($profileData->all());
    }
}
