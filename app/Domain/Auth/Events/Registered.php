<?php

namespace App\Domain\Auth\Events;

use App\Domain\Auth\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Registered
{
    use Dispatchable, SerializesModels;

    /** @var User */
    public $user;

    /** @var string */
    public $verifyEmailUrl;

    public function __construct(User $user, string $verifyEmailUrl)
    {
        $this->user = $user;
        $this->verifyEmailUrl = $verifyEmailUrl;
    }
}
