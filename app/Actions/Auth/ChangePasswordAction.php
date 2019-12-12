<?php

namespace App\Actions\Auth;

use App\DataTransferObjects\PasswordData;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ChangePasswordAction
{
    public function execute(User $user, PasswordData $passwordData): User
    {
        if (! Hash::check($passwordData->password, $user->password)) {
            throw ValidationException::withMessages(
                ['password' => [trans('validation.password')]]
            );
        }

        return tap($user)->update(['password' => Hash::make($passwordData->new_password)]);
    }
}
