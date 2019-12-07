<?php

namespace App\Notifications\Auth;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Lang;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;
    public $resetPasswordUrl;

    public function __construct($token, $resetPasswordUrl)
    {
        $this->token = $token;
        $this->resetPasswordUrl = $resetPasswordUrl;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(Lang::get('Reset Password Notification'))
            ->line(Lang::get('You are receiving this email because we received a password reset request for your account.'))
            ->action(Lang::get('Reset Password'), $this->buildResetPasswordUrl($notifiable))
            ->line(Lang::get('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(Lang::get('If you did not request a password reset, no further action is required.'));
    }

    protected function buildResetPasswordUrl($notifiable)
    {
        $query = http_build_query([
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]);

        return $this->resetPasswordUrl.(Str::contains($this->resetPasswordUrl, '?') ? '&' : '?').$query;
    }
}
