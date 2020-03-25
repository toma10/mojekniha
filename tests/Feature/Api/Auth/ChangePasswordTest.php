<?php

namespace Tests\Feature\Api\Auth;

use App\Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ChangePasswordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_authenticated()
    {
        $response = $this->postJson('api/auth/password');

        $response->assertUnauthorized();
    }

    /** @test */
    public function user_can_change_password()
    {
        $me = factory(User::class)->create(['password' => Hash::make('password')]);
        $data = [
            'password' => 'password',
            'new_password' => 'new-password',
            'new_password_confirmation' => 'new-password',
        ];

        $response = $this->actingAs($me->fresh())->postJson('api/auth/password', $data);

        $response->assertNoContent();
    }

    /** @test */
    public function password_must_be_correct()
    {
        $me = factory(User::class)->create(['password' => Hash::make('password')]);
        $data = [
            'password' => 'not-a-correct-password',
            'new_password' => 'new-password',
            'new_password_confirmation' => 'new-password',
        ];

        $response = $this->actingAs($me->fresh())->postJson('api/auth/password', $data);

        $response->assertJsonValidationErrors('password');
    }

    /** @test */
    public function it_requires_a_password()
    {
        $me = factory(User::class)->create();
        $data = [
            'password' => null,
            'new_password' => 'new-password',
            'new_password_confirmation' => 'new-password',
        ];

        $response = $this->actingAs($me->fresh())->postJson('api/auth/password', $data);

        $response->assertJsonValidationErrors('password');
    }

    /** @test */
    public function it_requires_a_new_password()
    {
        $me = factory(User::class)->create();
        $data = [
            'password' => 'password',
            'new_password' => null,
        ];

        $response = $this->actingAs($me->fresh())->postJson('api/auth/password', $data);

        $response->assertJsonValidationErrors('new_password');
    }

    /** @test */
    public function new_password_must_have_at_least_8_characters()
    {
        $me = factory(User::class)->create();
        $data = [
            'password' => 'password',
            'new_password' => 'abcdefg',
            'new_password_confirmation' => 'new-password',
        ];

        $response = $this->actingAs($me->fresh())->postJson('api/auth/password', $data);

        $response->assertJsonValidationErrors('new_password');
    }

    /** @test */
    public function new_password_must_be_confirmed()
    {
        $me = factory(User::class)->create();
        $data = [
            'password' => 'password',
            'new_password' => 'new-password',
            'new_password_confirmation' => 'secret',
        ];

        $response = $this->actingAs($me->fresh())->postJson('api/auth/password', $data);

        $response->assertJsonValidationErrors('new_password');
    }
}
