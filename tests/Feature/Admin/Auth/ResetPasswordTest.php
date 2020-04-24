<?php

namespace Tests\Feature\Admin\Auth;

use App\Domain\Auth\Models\PasswordReset;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function viewing_login_page()
    {
        $me = factory(User::class)->create();

        $this->get('admin/password/reset/RESET_TOKEN')
            ->assertOk();
    }

    /** @test */
    public function user_must_be_guest()
    {
        $me = factory(User::class)->create();

        $this->actingAs($me, 'web')->get('admin/password/reset/RESET_TOKEN')
            ->assertRedirect();

        $this->actingAs($me, 'web')->post('admin/password/reset')
            ->assertRedirect();
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
            'token' => $token,
            'email' => $me->email,
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ];

        $response = $this->post('admin/password/reset', $data);

        $response->assertRedirect('admin/login');
        $response->assertSessionHasFlashMessage('success');
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
            'token' => 'INVALID_RESET_TOKEN',
            'email' => $me->email,
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ];

        $response = $this->from('admin/password/reset/INVALID_RESET_TOKEN')->post('admin/password/reset', $data);

        $response->assertRedirect('admin/password/reset/INVALID_RESET_TOKEN');
        $response->assertSessionHasFlashMessage('error');
    }

    /** @test */
    public function it_403s_if_token_doesn_t_exist()
    {
        $me = factory(User::class)->create(['email' => 'johndoe@example.com']);
        $data = [
            'token' => 'RESET_TOKEN',
            'email' => 'johndoe@example.com',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ];

        $response = $this->from('admin/password/reset/RESET_TOKEN')->post('admin/password/reset', $data);

        $response->assertRedirect('admin/password/reset/RESET_TOKEN');
        $response->assertSessionHasFlashMessage('error');
    }

    /** @test */
    public function email_is_required()
    {
        $data = [
            'token' => 'RESET_TOKEN',
            'email' => null,
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ];

        $response = $this->post('admin/password/reset', $data);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function email_must_be_valid_email_address()
    {
        $data = [
            'token' => 'RESET_TOKEN',
            'email' => 'not-a-valid-email',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ];

        $response = $this->post('admin/password/reset', $data);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function email_must_exist()
    {
        factory(User::class)->create(['email' => 'johndoe@example.com']);
        $data = [
            'token' => 'RESET_TOKEN',
            'email' => 'johndoe@gmail.com',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ];

        $response = $this->post('admin/password/reset', $data);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function password_is_required()
    {
        factory(User::class)->create(['email' => 'johndoe@example.com']);
        $data = [
            'token' => 'RESET_TOKEN',
            'email' => 'johndoe@example.com',
            'password' => null,
        ];

        $response = $this->post('admin/password/reset', $data);

        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function password_must_have_at_least_8_characters()
    {
        factory(User::class)->create(['email' => 'johndoe@example.com']);
        $data = [
            'token' => 'RESET_TOKEN',
            'email' => 'johndoe@example.com',
            'password' => 'abcdefg',
            'password_confirmation' => 'abcdefg',
        ];

        $response = $this->post('admin/password/reset', $data);

        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function password_must_be_confirmed()
    {
        factory(User::class)->create(['email' => 'johndoe@example.com']);
        $data = [
            'token' => 'RESET_TOKEN',
            'email' => 'johndoe@example.com',
            'password' => 'new-password',
            'password_confirmation' => 'secret',
        ];

        $response = $this->post('admin/password/reset', $data);

        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function token_is_required()
    {
        factory(User::class)->create(['email' => 'johndoe@example.com']);
        $data = [
            'token' => null,
            'email' => 'johndoe@example.com',
            'password' => 'new-password',
            'password_confirmation' => 'secret',
        ];

        $response = $this->post('admin/password/reset', $data);

        $response->assertSessionHasErrors('token');
    }

    /** @test */
    public function token_must_be_string()
    {
        factory(User::class)->create(['email' => 'johndoe@example.com']);
        $data = [
            'token' => 123456,
            'email' => 'johndoe@example.com',
            'password' => 'new-password',
            'password_confirmation' => 'secret',
        ];

        $response = $this->post('admin/password/reset', $data);

        $response->assertSessionHasErrors('token');
    }
}
