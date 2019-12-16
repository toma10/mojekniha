<?php

namespace App\Domain\Auth\Actions;

use App\Domain\Auth\DataTransferObjects\RequestPasswordResetData;
use App\Domain\Auth\Models\User;
use App\Domain\Auth\Notifications\ResetPasswordNotification;
use App\Domain\Book\Models\PasswordReset;
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
