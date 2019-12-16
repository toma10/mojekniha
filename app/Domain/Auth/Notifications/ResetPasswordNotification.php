<?php

namespace App\Domain\Auth\Notifications;

use App\Domain\Shared\Support\Url;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    /** @var string */
    public $token;

    /** @var string */
    public $resetPasswordUrl;

    public function __construct(string $token, string $resetPasswordUrl)
    {
        $this->token = $token;
        $this->resetPasswordUrl = $resetPasswordUrl;
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
        $url = Url::build($this->resetPasswordUrl, [
            'email' => $notifiable->email,
            'token' => $this->token,
        ]);

        return (new MailMessage())
            ->subject(Lang::get('Reset Password Notification'))
            ->line(
                Lang::get('You are receiving this email because we received a password reset request for your account.')
            )
            ->action(Lang::get('Reset Password'), $url)
            ->line(Lang::get('If you did not request a password reset, no further action is required.'));
    }
}
