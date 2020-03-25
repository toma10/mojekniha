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

    /**
     * @param  mixed $notifiable
     */
    public function toMail(): MailMessage
    {
        return (new MailMessage())
            ->subject(Lang::get('Reset Password Notification'))
            ->line(
                Lang::get('You are receiving this email because we received a password reset request for your account.')
            )
            ->action(Lang::get('Reset Password'), $this->resetPasswordUrl)
            ->line(Lang::get('If you did not request a password reset, no further action is required.'));
    }
}
