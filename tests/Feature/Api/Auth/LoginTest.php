<?php

namespace Tests\Feature\Api\Auth;

use App\Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_logs_in_a_user()
    {
        $user = factory(User::class)->create([
            'email' => 'jonhnoe@example.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->postJson('api/auth/login', [
            'email' => 'jonhnoe@example.com',
            'password' => 'password',
        ]);

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => ['token'],
        ]);
    }

    /** @test */
    public function it_422s_if_invalid_credentials_provided()
    {
        $user = factory(User::class)->create([
            'email' => 'jonhnoe@example.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->postJson('api/auth/login', [
            'email' => 'jonhnoe@example.com',
            'password' => 'not-a-valid-password',
        ]);

        $response->assertJsonValidationErrors('email');
    }

    /** @test */
    public function it_requires_an_email()
    {
        $response = $this->postJson('api/auth/login', [
            'email' => null,
            'password' => Hash::make('password'),
        ]);

        $response->assertJsonValidationErrors('email');
    }

    /** @test */
    public function it_must_be_valid_email()
    {
        $response = $this->postJson('api/auth/login', [
            'email' => 'not-a-valid-email',
            'password' => Hash::make('password'),
        ]);

        $response->assertJsonValidationErrors('email');
    }

    /** @test */
    public function it_requires_a_password()
    {
        $response = $this->postJson('api/auth/login', [
            'email' => 'jonhnoe@example.com',
            'password' => null,
        ]);

        $response->assertJsonValidationErrors('password');
    }
}
