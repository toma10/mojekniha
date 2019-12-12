<?php

namespace App\Actions\Auth;

use App\DataTransferObjects\Auth\RequestPasswordResetData;
use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\Auth\ResetPasswordNotification;
use Facades\App\Support\PasswordResetTokenGenerator;

class RequestPasswordResetAction
{
    public function execute(RequestPasswordResetData $data): void
    {
        $token = PasswordResetTokenGenerator::generate();

        $user = User::findByEmail($data->email);

        PasswordReset::create([
            'email' => $user->email,
            'token' => $token,
        ]);

        $user->notify(new ResetPasswordNotification($token, $data->reset_password_url));
    }
}
