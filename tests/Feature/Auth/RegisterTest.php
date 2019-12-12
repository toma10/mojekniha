<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_403s_if_user_is_already_logged_in()
    {
        $user = factory(User::class)->create();

        $response = $this->login($user)->postJson('api/auth/register');

        $response->assertForbidden();
    }

    /** @test */
    public function it_registers_a_user()
    {
        Notification::fake();

        $data = [
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'verify_email_url' => 'http://url.dev',
        ];

        $response = $this->postJson('api/auth/register', $data);

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => ['token'],
        ]);
    }

    /** @test */
    public function it_requires_a_name()
    {
        $data = factory(User::class)->raw(['name' => null]);

        $response = $this->postJson('api/auth/register', $data);

        $response->assertJsonValidationErrors('name');
    }

    /** @test */
    public function it_requires_a_username()
    {
        $data = factory(User::class)->raw(['username' => null]);

        $response = $this->postJson('api/auth/register', $data);

        $response->assertJsonValidationErrors('username');
    }

    /** @test */
    public function username_must_be_unique()
    {
        factory(User::class)->create(['username' => 'johndoe']);
        $data = factory(User::class)->raw(['username' => 'johndoe']);

        $response = $this->postJson('api/auth/register', $data);

        $response->assertJsonValidationErrors('username');
    }

    /** @test */
    public function it_requires_an_email()
    {
        $data = factory(User::class)->raw(['email' => null]);

        $response = $this->postJson('api/auth/register', $data);

        $response->assertJsonValidationErrors('email');
    }

    /** @test */
    public function email_must_be_valid_email()
    {
        $data = factory(User::class)->raw(['email' => 'not-a-valid-email']);

        $response = $this->postJson('api/auth/register', $data);

        $response->assertJsonValidationErrors('email');
    }

    /** @test */
    public function email_must_be_unique()
    {
        factory(User::class)->create(['email' => 'johndoe@example.com']);
        $data = factory(User::class)->raw(['email' => 'johndoe@example.com']);

        $response = $this->postJson('api/auth/register', $data);

        $response->assertJsonValidationErrors('email');
    }

    /** @test */
    public function it_requires_a_password()
    {
        $data = factory(User::class)->raw(['password' => null]);

        $response = $this->postJson('api/auth/register', $data);

        $response->assertJsonValidationErrors('password');
    }

    /** @test */
    public function password_must_have_at_least_8_characters()
    {
        $data = factory(User::class)->raw(['password' => 'abcdefg']);

        $response = $this->postJson('api/auth/register', $data);

        $response->assertJsonValidationErrors('password');
    }

    /** @test */
    public function password_must_be_confirmed()
    {
        $data = factory(User::class)->raw([
            'password' => 'password',
            'password_confirmation' => 'secret',
        ]);

        $response = $this->postJson('api/auth/register', $data);

        $response->assertJsonValidationErrors('password');
    }

    /** @test */
    public function it_requires_a_verify_email_url()
    {
        $data = factory(User::class)->raw(['verify_email_url' => null]);

        $response = $this->postJson('api/auth/register', $data);

        $response->assertJsonValidationErrors('verify_email_url');
    }

    /** @test */
    public function verify_email_url_must_be_valid_url()
    {
        $data = factory(User::class)->raw(['verify_email_url' => 'not-a-valid-url']);

        $response = $this->postJson('api/auth/register', $data);

        $response->assertJsonValidationErrors('verify_email_url');
    }
}
