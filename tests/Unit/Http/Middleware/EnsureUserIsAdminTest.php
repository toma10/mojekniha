<?php

namespace Tests\Unit\Http\Middleware;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class EnsureUserIsAdminTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Route::get('/webhook-test', function () {
            return response()->json();
        })->middleware('admin');
    }

    /** @test */
    public function it_403s_if_user_is_not_authenticated()
    {
        $response = $this->getJson('/webhook-test');

        $response->assertForbidden();
    }

    /** @test */
    public function it_403s_if_user_is_not_an_admin()
    {
        $user = factory(User::class)->create();

        $response = $this->login($user)->getJson('/webhook-test');

        $response->assertForbidden();
    }

    /** @test */
    public function admin_can_continue()
    {
        $admin = factory(User::class)->state('admin')->create();

        $response = $this->login($admin)->getJson('/webhook-test');

        $response->assertOk();
    }
}
