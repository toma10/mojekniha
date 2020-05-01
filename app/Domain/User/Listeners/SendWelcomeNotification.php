<?php

namespace App\Domain\User\Listeners;

use App\Domain\User\Events\UserCreated;
use App\Domain\User\Notifications\WelcomeNotification;

class SendWelcomeNotification
{
    public function handle(UserCreated $event): void
    {
        $event->user->notify(new WelcomeNotification($event->user, $event->password));
    }
}
