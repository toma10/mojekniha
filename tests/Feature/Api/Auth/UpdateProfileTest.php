<?php

namespace Tests\Feature\Api\Auth;

use App\Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_authenticated()
    {
        $response = $this->putJson('api/auth/me');

        $response->assertUnauthorized();
    }

    /** @test */
    public function user_can_update_profile()
    {
        $me = factory(User::class)->create();
        $data = [
            'name' => 'John Doe',
            'username' => 'johndoe',
        ];

        $response = $this->actingAs($me->fresh())->putJson('api/auth/me', $data);

        $response->assertOk();
        $response->assertJson([
            'data' => [
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $me['email'],
            ],
        ]);
    }

    /** @test */
    public function it_requires_a_name()
    {
        $me = factory(User::class)->create();
        $data = [
            'name' => null,
            'username' => 'johndoe',
        ];

        $response = $this->actingAs($me->fresh())->putJson('api/auth/me', $data);

        $response->assertJsonValidationErrors('name');
    }

    /** @test */
    public function it_requires_a_username()
    {
        $me = factory(User::class)->create();
        $data = [
            'name' => 'John Doe',
            'username' => null,
        ];

        $response = $this->actingAs($me->fresh())->putJson('api/auth/me', $data);

        $response->assertJsonValidationErrors('username');
    }

    /** @test */
    public function username_must_be_unique()
    {
        $anotherUser = factory(User::class)->create(['username' => 'johndoe']);

        $me = factory(User::class)->create();
        $data = [
            'name' => 'John Doe',
            'username' => 'johndoe',
        ];

        $response = $this->actingAs($me->fresh())->putJson('api/auth/me', $data);

        $response->assertJsonValidationErrors('username');
    }

    /** @test */
    public function user_doesn_t_have_to_change_the_username()
    {
        $me = factory(User::class)->create(['username' => 'johndoe']);
        $data = [
            'name' => 'John Doe',
            'username' => 'johndoe',
        ];

        $response = $this->actingAs($me->fresh())->putJson('api/auth/me', $data);

        $response->assertJsonMissingValidationErrors('username');
    }

    /** @test */
    public function user_can_t_change_email()
    {
        $me = factory(User::class)->create(['email' => 'johndoe@example.com']);
        $data = [
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'johnnyd@example.com',
        ];

        $response = $this->actingAs($me->fresh())->putJson('api/auth/me', $data);

        $response->assertOk();
        $this->assertEquals('johndoe@example.com', $me->email);
    }
}
