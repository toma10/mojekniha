<?php

namespace App\Actions;

use App\DataTransferObjects\ProfileData;
use App\Models\User;

class UpdateProfileAction
{
    public function execute(User $user, ProfileData $profileData): User
    {
        return tap($user)->update($profileData->all());
    }
}
