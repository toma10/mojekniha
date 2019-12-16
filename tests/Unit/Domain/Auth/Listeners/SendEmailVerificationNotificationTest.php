<?php

namespace Tests\Unit\Domain\Auth\Listeners;

use App\Domain\Auth\Events\Registered;
use App\Domain\Auth\Models\User;
use App\Domain\Auth\Notifications\VerifyEmailNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class SendEmailVerificationNotificationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_sends_email_verification_notification_if_user_hasnt_t_verified_email()
    {
        Notification::fake();

        $user = factory(User::class)->create(['email_verified_at' => null]);
        $verifyEmailUrl = 'http://url.dev';

        Registered::dispatch($user, $verifyEmailUrl);

        Notification::assertSentTo(
            $user,
            VerifyEmailNotification::class,
            function ($notification, $channels, $notifiable) use ($user, $verifyEmailUrl) {
                return  $notifiable->email === $user->email
                    &&  $notification->verifyEmailUrl === $verifyEmailUrl;
            }
        );
    }
}
