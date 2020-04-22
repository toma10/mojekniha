<?php

namespace App\Domain\Auth\Listeners;

use App\Domain\Auth\Events\UserCreated;
use App\Domain\Auth\Notifications\WelcomeNotification;

class SendWelcomeNotification
{
    public function handle(UserCreated $event): void
    {
        $event->user->notify(new WelcomeNotification($event->user, $event->password));
    }
}
