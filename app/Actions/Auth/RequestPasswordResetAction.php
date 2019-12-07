<?php

namespace App\Actions\Auth;

use App\Models\User;
use App\Models\PasswordReset;
use Facades\App\Support\PasswordResetTokenGenerator;
use App\Notifications\Auth\ResetPasswordNotification;
use App\DataTransferObjects\Auth\RequestPasswordResetData;

class RequestPasswordResetAction
{
    public function execute(RequestPasswordResetData $data): void
    {
        $token = PasswordResetTokenGenerator::generate();

        $user = User::whereEmail($data->email)->firstOrFail();

        PasswordReset::create([
            'email' => $user->email,
            'token' => $token,
        ]);

        $user->notify(new ResetPasswordNotification($token, $data->reset_password_url));
    }
}
