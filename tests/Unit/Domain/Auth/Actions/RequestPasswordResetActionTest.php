<?php

namespace Tests\Unit\Domain\Auth\Actions;

use App\Domain\Auth\Actions\RequestPasswordResetAction;
use App\Domain\Auth\DataTransferObjects\RequestPasswordResetData;
use App\Domain\Auth\Models\PasswordReset;
use App\Domain\Auth\Notifications\ResetPasswordNotification;
use App\Domain\User\Models\User;
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
            'reset_password_url' => $resetPasswordUrl = 'http://url.dev/password/reset',
        ]);

        (new RequestPasswordResetAction())->execute($requestPasswordResetData);

        $this->assertCount(1, PasswordReset::where([
            'email' => $me->email,
            'token' => $token,
        ])->get());

        Notification::assertSentTo(
            $me,
            ResetPasswordNotification::class,
            function ($notification) use ($resetPasswordUrl, $token) {
                return $notification->resetPasswordUrl === sprintf('%s/%s', $resetPasswordUrl, $token);
            }
        );
    }
}
