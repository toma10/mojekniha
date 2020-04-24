<?php

namespace Tests\Feature\Api\Auth;

use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ResendEmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_authenticated()
    {
        $response = $this->postJson('api/auth/email/resend');

        $response->assertUnauthorized();
    }

    /** @test */
    public function user_can_ask_for_resend_email_verification()
    {
        Notification::fake();

        $me = factory(User::class)->create();
        $data = ['verify_email_url' => 'http://url.dev'];

        $response = $this->actingAs($me)->postJson('api/auth/email/resend', $data);

        $response->assertNoContent();
    }

    /** @test */
    public function it_requires_a_verify_email_url()
    {
        $me = factory(User::class)->create();
        $data = ['verify_email_url' => null];

        $response = $this->actingAs($me)->postJson('api/auth/email/resend', $data);

        $response->assertJsonValidationErrors('verify_email_url');
    }

    /** @test */
    public function verify_email_url_must_be_valid_url()
    {
        $me = factory(User::class)->create();
        $data = ['verify_email_url' => 'not-a-valid-url'];

        $response = $this->actingAs($me)->postJson('api/auth/email/resend', $data);

        $response->assertJsonValidationErrors('verify_email_url');
    }
}
