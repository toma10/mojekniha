<?php

namespace Tests\Feature\Admin\Auth;

use App\Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_authenticated()
    {
        $this->post('admin/logout')
            ->assertRedirect('admin/login');
    }

    /** @test */
    public function it_logs_out_the_user()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user, 'web')->post('admin/logout');

        $response->assertRedirect('admin/login');
    }
}
