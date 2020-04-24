<?php

namespace App\Providers;

use App\Domain\Auth\Events\Registered;
use App\Domain\user\Events\UserCreated;
use App\Domain\Auth\Listeners\SendEmailVerificationNotification;
use App\Domain\User\Listeners\SendWelcomeNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /** @var array<array<string>> */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserCreated::class => [
            SendWelcomeNotification::class,
        ],
    ];
}
