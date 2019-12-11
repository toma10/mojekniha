<?php

namespace App\Events\Auth;

use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class Registered
{
    use Dispatchable, SerializesModels;

    public $user;
    public $verifyEmailUrl;

    public function __construct(User $user, string $verifyEmailUrl)
    {
        $this->user = $user;
        $this->verifyEmailUrl = $verifyEmailUrl;
    }
}
