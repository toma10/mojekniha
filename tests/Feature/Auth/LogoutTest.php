<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_authenticated()
    {
        $response = $this->postJson('api/auth/logout');

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_logs_out_the_user()
    {
        $user = factory(User::class)->create();

        $response = $this->login($user)->postJson('api/auth/logout');

        $response->assertOk();
    }
}