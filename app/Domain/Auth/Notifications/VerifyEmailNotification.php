<?php

namespace App\Domain\Auth\Notifications;

use App\Domain\Shared\Notifications\BaseNotification;
use App\Domain\Shared\Support\Url;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class VerifyEmailNotification extends BaseNotification
{
    public string $verifyEmailUrl;

    public function __construct(string $verifyEmailUrl)
    {
        $this->verifyEmailUrl = $verifyEmailUrl;
    }

    /**
     * @param  mixed $notifiable
     */
    public function toMail($notifiable): MailMessage
    {
        $url = Url::build($this->verifyEmailUrl, [
            'id' => $notifiable->id,
            'hash' => sha1($notifiable->email),
        ]);

        return (new MailMessage())
            ->subject(Lang::get('notifications.verifyEmail.subject'))
            ->line(Lang::get('notifications.verifyEmail.pleaseClickButton'))
            ->action(Lang::get('notifications.verifyEmail.verifyEmailAddress'), $url)
            ->line(Lang::get('notifications.verifyEmail.notCreatedAccount'));
    }
}
