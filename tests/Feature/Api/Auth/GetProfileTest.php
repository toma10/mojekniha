<?php

namespace Tests\Feature\Api\Auth;

use App\Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_authenticated()
    {
        $response = $this->getJson('api/auth/me');

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_returns_user_info()
    {
        $me = factory(User::class)->create();

        $response = $this->actingAs($me->fresh())->getJson('api/auth/me');

        $response->assertOk();
        $response->assertExactJson([
            'data' => [
                'name' => $me->name,
                'username' => $me->username,
                'email' => $me->email,
            ],
        ]);
    }
}
