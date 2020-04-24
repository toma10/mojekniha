<?php

namespace Tests\Feature\Api\Auth;

use App\Domain\Auth\Models\PasswordReset;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_guest()
    {
        $me = factory(User::class)->create();

        $this->actingAs($me)->postJson('api/auth/password/reset/RESET_TOKEN')
            ->assertForbidden();
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
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ];

        $response = $this->postJson("api/auth/password/reset/{$token}", $data);

        $response->assertStatus(202);
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
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ];

        $response = $this->postJson('api/auth/password/reset/INVALID_RESET_TOKEN', $data);

        $response->assertForbidden();
    }

    /** @test */
    public function it_403s_if_token_doesn_t_exist()
    {
        $me = factory(User::class)->create(['email' => 'johndoe@example.com']);
        $data = [
            'email' => 'johndoe@example.com',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ];

        $response = $this->postJson('api/auth/password/reset/RESET_TOKEN', $data);

        $response->assertForbidden();
    }

    /** @test */
    public function email_is_required()
    {
        $data = [
            'email' => null,
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ];

        $response = $this->postJson('api/auth/password/reset/RESET_TOKEN', $data);

        $response->assertJsonValidationErrors('email');
    }

    /** @test */
    public function email_must_be_valid_email_address()
    {
        $data = [
            'email' => 'not-a-valid-email',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ];

        $response = $this->postJson('api/auth/password/reset/RESET_TOKEN', $data);

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

        $response = $this->postJson('api/auth/password/reset/RESET_TOKEN', $data);

        $response->assertJsonValidationErrors('email');
    }

    /** @test */
    public function password_is_required()
    {
        factory(User::class)->create(['email' => 'johndoe@example.com']);
        $data = [
            'email' => 'johndoe@example.com',
            'password' => null,
        ];

        $response = $this->postJson('api/auth/password/reset/RESET_TOKEN', $data);

        $response->assertJsonValidationErrors('password');
    }

    /** @test */
    public function password_must_have_at_least_8_characters()
    {
        factory(User::class)->create(['email' => 'johndoe@example.com']);
        $data = [
            'email' => 'johndoe@example.com',
            'password' => 'abcdefg',
            'password_confirmation' => 'abcdefg',
        ];

        $response = $this->postJson('api/auth/password/reset/RESET_TOKEN', $data);

        $response->assertJsonValidationErrors('password');
    }

    /** @test */
    public function password_must_be_confirmed()
    {
        factory(User::class)->create(['email' => 'johndoe@example.com']);
        $data = [
            'email' => 'johndoe@example.com',
            'password' => 'new-password',
            'password_confirmation' => 'secret',
        ];

        $response = $this->postJson('api/auth/password/reset/RESET_TOKEN', $data);

        $response->assertJsonValidationErrors('password');
    }
}
