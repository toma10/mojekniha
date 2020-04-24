<?php

namespace Tests\Unit\Domain\Auth\Actions;

use App\Domain\Auth\Actions\ResendEmailVerificationAction;
use App\Domain\Auth\DataTransferObjects\ResendEmailVerificationData;
use App\Domain\Auth\Notifications\VerifyEmailNotification;
use App\Domain\User\Models\User;
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
            function ($notification) use ($verifyEmailUrl) {
                return $notification->verifyEmailUrl === $verifyEmailUrl;
            }
        );
    }

    /** @test */
    public function it_doesn_t_send_notification_if_email_is_already_verified()
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
