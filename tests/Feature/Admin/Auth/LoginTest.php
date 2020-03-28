<?php

namespace Tests\Feature\Admin\Auth;

use App\Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function viewing_login_page()
    {
        $this->get('admin/login')
            ->assertOk();
    }

    /** @test */
    public function user_must_be_guest()
    {
        $user = factory(User::class)->state('admin')->create();

        $this->actingAs($user, 'web')->get('admin/login')
            ->assertRedirect();

        $this->actingAs($user, 'web')->post('admin/login')
            ->assertRedirect();
    }

    /** @test */
    public function it_logs_in_an_admin()
    {
        $user = factory(User::class)->state('admin')->create([
            'email' => 'jonhnoe@example.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->post('admin/login', [
            'email' => 'jonhnoe@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('admin');
        $this->assertAuthenticatedAs($user, 'web');
    }

    /** @test */
    public function user_must_be_admin()
    {
        factory(User::class)->create([
            'email' => 'jonhnoe@example.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->post('admin/login', [
            'email' => 'jonhnoe@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(403);
        $this->assertGuest('web');
    }

    public function it_422s_if_invalid_credentials_provided()
    {
        $user = factory(User::class)->create([
            'email' => 'jonhnoe@example.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->post('admin/login', [
            'email' => 'jonhnoe@example.com',
            'password' => 'not-a-valid-password',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function it_requires_an_email()
    {
        $response = $this->post('admin/login', [
            'email' => null,
            'password' => Hash::make('password'),
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function it_must_be_valid_email()
    {
        $response = $this->post('admin/login', [
            'email' => 'not-a-valid-email',
            'password' => Hash::make('password'),
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function it_requires_a_password()
    {
        $response = $this->post('admin/login', [
            'email' => 'jonhnoe@example.com',
            'password' => null,
        ]);

        $response->assertSessionHasErrors('password');
    }
}
