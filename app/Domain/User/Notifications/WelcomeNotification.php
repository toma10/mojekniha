<?php

namespace App\Domain\User\Notifications;

use App\Domain\User\Models\User;
use App\Domain\Shared\Notifications\BaseNotification;
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
            ->subject(Lang::get('Welcome to :name', ['name' => config('app.name')]))
            ->greeting(Lang::get('Hello :name!', ['name' => $this->user->name]))
            ->line(Lang::get('Here is your password: :password', ['password' => $this->password]));
    }
}
