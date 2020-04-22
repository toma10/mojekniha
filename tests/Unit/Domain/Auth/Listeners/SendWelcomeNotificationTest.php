<?php

namespace Tests\Unit\Domain\Auth\Listeners;

use App\Domain\Auth\Events\UserCreated;
use App\Domain\Auth\Models\User;
use App\Domain\Auth\Notifications\WelcomeNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class SendWelcomeNotificationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_sends_welcome_notification()
    {
        Notification::fake();

        $user = factory(User::class)->create();
        $password = 'PASSWORD';

        UserCreated::dispatch($user, $password);

        Notification::assertSentTo(
            $user,
            WelcomeNotification::class,
            function ($notification) use ($user, $password) {
                return $notification->user->is($user)
                    && $notification->password === $password;
            }
        );
    }
}
