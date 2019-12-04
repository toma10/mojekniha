<?php

namespace App\Actions;

use App\Models\User;
use App\DataTransferObjects\ProfileData;

class UpdateProfileAction
{
    public function execute(User $user, ProfileData $profileData): User
    {
        return tap($user)->update($profileData->all());
    }
}
