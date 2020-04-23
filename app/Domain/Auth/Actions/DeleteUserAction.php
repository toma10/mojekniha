<?php

namespace App\Domain\Auth\Actions;

use App\Domain\Auth\Models\User;

class DeleteUserAction
{
    public function execute(User $user): void
    {
        $user->delete();
    }
}
