<?php

namespace App\Domain\Auth\Notifications;

use App\Domain\Shared\Notifications\BaseNotification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class ResetPasswordNotification extends BaseNotification
{
    public string $resetPasswordUrl;

    public function __construct(string $resetPasswordUrl)
    {
        $this->resetPasswordUrl = $resetPasswordUrl;
    }

    public function toMail(): MailMessage
    {
        return (new MailMessage())
            ->subject(Lang::get('notifications.resetPassword.subject'))
            ->line(
                Lang::get('notifications.resetPassword.resetPasswordRequestEmail')
            )
            ->action(Lang::get('notifications.resetPassword.resetPassword'), $this->resetPasswordUrl)
            ->line(Lang::get('notifications.resetPassword.notRequested'));
    }
}
