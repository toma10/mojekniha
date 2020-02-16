<?php

namespace Tests\Unit\Domain\Auth\Actions;

use App\Domain\Auth\Actions\RequestPasswordResetAction;
use App\Domain\Auth\DataTransferObjects\RequestPasswordResetData;
use App\Domain\Auth\Models\User;
use App\Domain\Auth\Notifications\ResetPasswordNotification;
use App\Domain\Book\Models\PasswordReset;
use Facades\App\Domain\Auth\Support\PasswordResetTokenGenerator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class RequestPasswordResetActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_request_password_reset()
    {
        Notification::fake();

        PasswordResetTokenGenerator::shouldReceive('generate')
            ->once()
            ->andReturn($token = 'RESET_TOKEN');

        $me = factory(User::class)->create(['email' => 'johndoe@examlple.com']);
        $requestPasswordResetData = new RequestPasswordResetData([
            'email' => $me->email,
            'reset_password_url' => $resetPasswordUrl = 'http://url.dev',
        ]);

        (new RequestPasswordResetAction())->execute($requestPasswordResetData);

        $this->assertPasswordResetCreated($me, $token);
        $this->assertResetPasswordNotificationSent($me, $token, $resetPasswordUrl);
    }

    protected function assertPasswordResetCreated(User $user, $token)
    {
        $this->assertCount(1, PasswordReset::where([
            'email' => $user->email,
            'token' => $token,
        ])->get());
    }

    protected function assertResetPasswordNotificationSent(User $user, $token, $resetPasswordUrl)
    {
        Notification::assertSentTo(
            $user,
            ResetPasswordNotification::class,
            function ($notification, $channels, $notifiable) use ($user, $token, $resetPasswordUrl) {
                return $notification->token === $token
                    && $notification->resetPasswordUrl === $resetPasswordUrl
                    && $notifiable->email === $user->email;
            }
        );
    }
}