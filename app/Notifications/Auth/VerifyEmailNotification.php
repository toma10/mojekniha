<?php

namespace App\Notifications\Auth;

use App\Support\Url;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class VerifyEmailNotification extends Notification
{
    use Queueable;

    /** @var string */
    public $verifyEmailUrl;

    public function __construct(string $verifyEmailUrl)
    {
        $this->verifyEmailUrl = $verifyEmailUrl;
    }

    /**
     * @return array<string>
     */
    public function via(): array
    {
        return ['mail'];
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
            ->subject(Lang::get('Verify Email Address'))
            ->line(Lang::get('Please click the button below to verify your email address.'))
            ->action(Lang::get('Verify Email Address'), $url)
            ->line(Lang::get('If you did not create an account, no further action is required.'));
    }
}
