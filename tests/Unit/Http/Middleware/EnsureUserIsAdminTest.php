<?php

namespace Tests\Unit\Http\Middleware;

use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class EnsureUserIsAdminTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Route::get('webhook-test', function () {
            return response()->json();
        })->middleware('admin');

        Route::get('view', function () {
            return response()->noContent();
        })->middleware('admin');
    }

    /** @test */
    public function it_403s_if_user_is_not_authenticated()
    {
        $response = $this->getJson('webhook-test');

        $response->assertForbidden();
    }

    /** @test */
    public function it_403s_if_user_is_not_an_admin()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->getJson('webhook-test');

        $response->assertForbidden();
    }

    /** @test */
    public function it_redirects_to_admin_login_page_if_not_json_request()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('view');

        $response->assertRedirect('admin/login');
    }

    /** @test */
    public function admin_can_continue()
    {
        $admin = factory(User::class)->state('admin')->create();

        $response = $this->actingAs($admin)->getJson('webhook-test');

        $response->assertOk();
    }
}
