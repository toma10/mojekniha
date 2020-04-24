<?php

namespace Tests\Feature\Api\Auth;

use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_authenticated()
    {
        $this->postJson('api/auth/logout')
            ->assertUnauthorized();
    }

    /** @test */
    public function it_logs_out_the_user()
    {
        $user = factory(User::class)->create();

        auth()->login($user);
        $response = $this->postJson('api/auth/logout');

        $response->assertOk();
    }
}
