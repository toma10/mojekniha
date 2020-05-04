<?php

namespace App\Domain\User\Notifications;

use App\Domain\Shared\Notifications\BaseNotification;
use App\Domain\User\Models\User;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class WelcomeNotification extends BaseNotification
{
    public User $user;

    public string $password;

    public function __construct(User $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function toMail(): MailMessage
    {
        return (new MailMessage())
            ->subject(Lang::get('notifications.welcome.subject', ['name' => config('app.name')]))
            ->greeting(Lang::get('notifications.welcome.greeting', ['name' => $this->user->name]))
            ->line(Lang::get('notifications.welcome.yourPassword', ['password' => $this->password]));
    }
}
