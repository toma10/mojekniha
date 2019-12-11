<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VerifyEmailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_authenticated()
    {
        $response = $this->postJson('api/auth/email/verify');

        $response->assertUnauthorized();
    }

    /** @test */
    public function user_can_verify_email()
    {
        $me = factory(User::class)->create();
        $data = [
            'id' => $me->id,
            'hash' => sha1($me->email),
        ];

        $response = $this->login($me)->postJson('api/auth/email/verify', $data);

        $response->assertNoContent();
    }

    /** @test */
    public function it_403_if_invalid_data_provided()
    {
        $me = factory(User::class)->create();
        $data = [
            'id' => 999,
            'hash' => sha1($me->email),
        ];

        $response = $this->login($me)->postJson('api/auth/email/verify', $data);

        $response->assertForbidden();
    }

    /** @test */
    public function it_requires_an_id()
    {
        $me = factory(User::class)->create();
        $data = ['hash' => 'HASH'];

        $response = $this->login($me)->postJson('api/auth/email/verify', $data);

        $response->assertJsonValidationErrors('id');
    }

    /** @test */
    public function id_must_be_int()
    {
        $me = factory(User::class)->create();
        $data = [
            'id' => 'not-a-valid-int',
            'hash' => 'HASH'
        ];

        $response = $this->login($me)->postJson('api/auth/email/verify', $data);

        $response->assertJsonValidationErrors('id');
    }

    /** @test */
    public function it_requires_an_hash()
    {
        $me = factory(User::class)->create();
        $data = ['id' => $me->id];

        $response = $this->login($me)->postJson('api/auth/email/verify', $data);

        $response->assertJsonValidationErrors('hash');
    }

    /** @test */
    public function hash_must_be_string()
    {
        $me = factory(User::class)->create();
        $data = [
            'id' => $me->id,
            'hash' => 123,
        ];

        $response = $this->login($me)->postJson('api/auth/email/verify', $data);

        $response->assertJsonValidationErrors('hash');
    }
}
