<?php

namespace App\Domain\Auth\Listeners;

use App\Domain\Auth\Events\Registered;
use App\Domain\Auth\Notifications\VerifyEmailNotification;

class SendEmailVerificationNotification
{
    public function handle(Registered $event): void
    {
        if (! $event->user->hasVerifiedEmail()) {
            $event->user->notify(new VerifyEmailNotification($event->verifyEmailUrl));
        }
    }
}
