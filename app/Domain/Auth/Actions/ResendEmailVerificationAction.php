<?php

namespace App\Domain\Auth\Actions;

use App\Domain\Auth\DataTransferObjects\ResendEmailVerificationData;
use App\Domain\User\Models\User;
use App\Domain\Auth\Notifications\VerifyEmailNotification;

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
