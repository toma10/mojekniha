<?php

namespace App\Notifications\Auth;

use App\Support\Url;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Lang;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmailNotification extends Notification
{
    use Queueable;

    public $verifyEmailUrl;

    public function __construct($verifyEmailUrl)
    {
        $this->verifyEmailUrl = $verifyEmailUrl;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = Url::build($this->verifyEmailUrl, [
            'id' => $notifiable->id,
            'hash' => sha1($notifiable->email),
        ]);

        return (new MailMessage)
            ->subject(Lang::get('Verify Email Address'))
            ->line(Lang::get('Please click the button below to verify your email address.'))
            ->action(Lang::get('Verify Email Address'), $url)
            ->line(Lang::get('If you did not create an account, no further action is required.'));
    }
}
