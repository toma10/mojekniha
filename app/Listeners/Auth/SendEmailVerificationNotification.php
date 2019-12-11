<?php

namespace App\Listeners\Auth;

use App\Events\Auth\Registered;
use App\Notifications\Auth\VerifyEmailNotification;

class SendEmailVerificationNotification
{
    public function handle(Registered $event)
    {
        if (!$event->user->hasVerifiedEmail()) {
            $event->user->notify(new VerifyEmailNotification($event->verifyEmailUrl));
        }
    }
}
