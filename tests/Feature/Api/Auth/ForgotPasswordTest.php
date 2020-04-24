<?php

namespace Tests\Feature\Api\Auth;

use App\Domain\Auth\Notifications\ResetPasswordNotification;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_guest()
    {
        $me = factory(User::class)->create();

        $this->actingAs($me)->postJson('api/auth/password/reset')
            ->assertForbidden();
    }

    /** @test */
    public function user_can_request_password_reset()
    {
        Notification::fake();

        $me = factory(User::class)->create(['email' => 'johndoe@example.com']);

        $response = $this->postJson('api/auth/password/reset', [
            'email' => 'johndoe@example.com',
            'reset_password_url' => 'http://url.dev/password/reset',
        ]);

        $response->assertStatus(Response::HTTP_ACCEPTED);

        Notification::assertSentTo($me, ResetPasswordNotification::class);
    }

    /** @test */
    public function email_is_required()
    {
        $data = [
            'email' => null,
            'reset_password_url' => 'http://url.dev',
        ];

        $response = $this->postJson('api/auth/password/reset', $data);

        $response->assertJsonValidationErrors('email');
    }

    /** @test */
    public function email_must_be_valid_email_address()
    {
        $data = [
            'email' => 'not-a-valid-email',
            'reset_password_url' => 'http://url.dev',
        ];

        $response = $this->postJson('api/auth/password/reset', $data);

        $response->assertJsonValidationErrors('email');
    }

    /** @test */
    public function email_must_exist()
    {
        factory(User::class)->create(['email' => 'johndoe@example.com']);
        $data = [
            'email' => 'johndoe@gmail.com',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ];

        $response = $this->postJson('api/auth/password/reset', $data);

        $response->assertJsonValidationErrors('email');
    }

    /** @test */
    public function reset_password_url_is_required()
    {
        factory(User::class)->create(['email' => 'johndoe@example.com']);
        $data = [
            'email' => 'johndoe@example.com',
            'reset_password_url' => null,
        ];

        $response = $this->postJson('api/auth/password/reset', $data);

        $response->assertJsonValidationErrors('reset_password_url');
    }

    /** @test */
    public function reset_password_url_must_be_valid_url()
    {
        factory(User::class)->create(['email' => 'johndoe@example.com']);
        $data = [
            'email' => 'johndoe@example.com',
            'reset_password_url' => 'not-a-valid-url',
        ];

        $response = $this->postJson('api/auth/password/reset', $data);

        $response->assertJsonValidationErrors('reset_password_url');
    }
}
