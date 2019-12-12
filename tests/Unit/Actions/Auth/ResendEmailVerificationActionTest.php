<?php

namespace Tests\Unit\Actions\Auth;

use App\Actions\Auth\ResendEmailVerificationAction;
use App\DataTransferObjects\Auth\ResendEmailVerificationData;
use App\Models\User;
use App\Notifications\Auth\VerifyEmailNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ResendEmailVerificationActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_resends_email_verification()
    {
        Notification::fake();

        $me = factory(User::class)->create();

        $verifyEmailData = new ResendEmailVerificationData([
            'verify_email_url' => $verifyEmailUrl = 'http://url.dev',
        ]);

        (new ResendEmailVerificationAction())->execute($me, $verifyEmailData);

        Notification::assertSentTo(
            $me,
            VerifyEmailNotification::class,
            function ($notification, $channels, $notifiable) use ($me, $verifyEmailUrl) {
                return  $notifiable->email === $me->email
                    &&  $notification->verifyEmailUrl === $verifyEmailUrl;
            }
        );
    }

    /** @test */
    public function id_doesn_t_send_notification_if_email_is_already_verified()
    {
        Notification::fake();

        $me = factory(User::class)->states('verified')->create();

        $verifyEmailData = new ResendEmailVerificationData([
            'verify_email_url' => $verifyEmailUrl = 'http://url.dev',
        ]);

        (new ResendEmailVerificationAction())->execute($me, $verifyEmailData);

        Notification::assertNothingSent();
    }
}
