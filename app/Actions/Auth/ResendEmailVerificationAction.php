<?php

namespace App\Actions\Auth;

use App\Models\User;
use App\Notifications\Auth\VerifyEmailNotification;
use App\DataTransferObjects\Auth\ResendEmailVerificationData;

class ResendEmailVerificationAction
{
    public function execute(User $user, ResendEmailVerificationData $resendEmailVerificationData): void
    {
        if ($user->hasVerifiedEmail()) {
            return;
        }

        $user->notify(new VerifyEmailNotification($resendEmailVerificationData->verify_email_url));
    }
}
