<?php

namespace Tests\Feature\Api\Auth;

use App\Domain\Auth\Models\PasswordReset;
use App\Domain\Auth\Models\User;
use App\Domain\Auth\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_guest()
    {
        $me = factory(User::class)->create();

        $response = $this->login($me)->putJson('api/auth/password');

        $response->assertForbidden();
    }

    /** @test */
    public function user_can_request_password_reset()
    {
        Notification::fake();

        $me = factory(User::class)->create(['email' => 'johndoe@example.com']);

        $response = $this->putJson('api/auth/password', [
            'email' => 'johndoe@example.com',
            'reset_password_url' => 'http://url.dev',
        ]);

        $response->assertStatus(Response::HTTP_ACCEPTED);

        Notification::assertSentTo($me, ResetPasswordNotification::class);
    }

    /** @test */
    public function user_can_reset_password_with_valid_token()
    {
        $me = factory(User::class)->create(['email' => 'johndoe@example.com']);
        factory(PasswordReset::class)->create([
            'email' => $me->email,
            'token' => $token = 'RESET_TOKEN',
        ]);
        $data = [
            'email' => $me->email,
            'token' => $token,
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ];

        $response = $this->putJson('api/auth/password', $data);

        $response->assertNoContent();
    }

    /** @test */
    public function it_403s_if_token_is_invalid()
    {
        $me = factory(User::class)->create(['email' => 'johndoe@example.com']);
        factory(PasswordReset::class)->create([
            'email' => $me->email,
            'token' => 'RESET_TOKEN',
        ]);
        $data = [
            'email' => $me->email,
            'token' => 'INVALID_RESET_TOKEN',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ];

        $response = $this->putJson('api/auth/password', $data);

        $response->assertForbidden();
    }

    /** @test */
    public function it_403s_if_token_doesn_t_exist()
    {
        $me = factory(User::class)->create(['email' => 'johndoe@example.com']);
        $data = [
            'email' => 'johndoe@example.com',
            'token' => 'RESET_TOKEN',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ];

        $response = $this->putJson('api/auth/password', $data);

        $response->assertForbidden();
    }

    /** @test */
    public function email_is_required()
    {
        $data = [
            'email' => null,
            'reset_password_url' => 'http://url.dev',
        ];

        $response = $this->putJson('api/auth/password', $data);

        $response->assertJsonValidationErrors('email');
    }

    /** @test */
    public function email_must_be_valid_email_address()
    {
        $data = [
            'email' => 'not-avalid-email',
            'reset_password_url' => 'http://url.dev',
        ];

        $response = $this->putJson('api/auth/password', $data);

        $response->assertJsonValidationErrors('email');
    }

    /** @test */
    public function email_must_exist()
    {
        factory(User::class)->create(['email' => 'johndoe@example.com']);
        $data = [
            'email' => 'johndoe@gmail.com',
            'reset_password_url' => 'http://url.dev',
        ];

        $response = $this->putJson('api/auth/password', $data);

        $response->assertJsonValidationErrors('email');
    }

    /** @test */
    public function reset_password_url_is_required_if_token_is_not_provided()
    {
        factory(User::class)->create(['email' => 'johndoe@example.com']);
        $data = [
            'email' => 'johndoe@example.com',
            'reset_password_url' => null,
        ];

        $response = $this->putJson('api/auth/password', $data);

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

        $response = $this->putJson('api/auth/password', $data);

        $response->assertJsonValidationErrors('reset_password_url');
    }

    /** @test */
    public function token_password_url_is_required_if_reset_password_token_is_not_provided()
    {
        factory(User::class)->create(['email' => 'johndoe@example.com']);
        $data = [
            'email' => 'johndoe@example.com',
            'token' => null,
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ];

        $response = $this->putJson('api/auth/password', $data);

        $response->assertJsonValidationErrors('token');
    }

    /** @test */
    public function password_is_required_if_token_is_provided()
    {
        factory(User::class)->create(['email' => 'johndoe@example.com']);
        $data = [
            'email' => 'johndoe@example.com',
            'token' => 'RESET_TOKEN',
            'password' => null,
        ];

        $response = $this->putJson('api/auth/password', $data);

        $response->assertJsonValidationErrors('password');
    }

    /** @test */
    public function password_must_have_at_least_8_characters()
    {
        factory(User::class)->create(['email' => 'johndoe@example.com']);
        $data = [
            'email' => 'johndoe@example.com',
            'token' => 'RESET_TOKEN',
            'password' => 'abcdefg',
            'password_confirmation' => 'abcdefg',
        ];

        $response = $this->putJson('api/auth/password', $data);

        $response->assertJsonValidationErrors('password');
    }

    /** @test */
    public function password_must_be_confirmed()
    {
        factory(User::class)->create(['email' => 'johndoe@example.com']);
        $data = [
            'email' => 'johndoe@example.com',
            'token' => 'RESET_TOKEN',
            'password' => 'new-password',
            'password_confirmation' => 'secret',
        ];

        $response = $this->putJson('api/auth/password', $data);

        $response->assertJsonValidationErrors('password');
    }
}
