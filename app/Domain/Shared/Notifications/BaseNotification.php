<?php

namespace App\Domain\Shared\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;

class BaseNotification extends Notification
{
    use Queueable, SerializesModels;

    /**
     * @return array<string>
     */
    public function via(): array
    {
        return ['mail'];
    }
}
