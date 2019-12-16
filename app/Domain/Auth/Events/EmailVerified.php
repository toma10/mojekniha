<?php

namespace App\Domain\Auth\Events;

use App\Domain\Auth\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmailVerified
{
    use Dispatchable, SerializesModels;

    /** @var User */
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
