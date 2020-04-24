<?php

namespace App\Domain\Auth\Events;

use App\Domain\User\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Registered
{
    use Dispatchable, SerializesModels;

    public User $user;

    public string $verifyEmailUrl;

    public function __construct(User $user, string $verifyEmailUrl)
    {
        $this->user = $user;
        $this->verifyEmailUrl = $verifyEmailUrl;
    }
}
