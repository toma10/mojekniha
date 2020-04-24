<?php

namespace Tests\Feature\Admin\Auth;

use App\Domain\User\Models\User;
use App\Domain\Auth\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function viewing_forgot_password_page()
    {
        $this->get('admin/password/reset')
            ->assertOk();
    }

    /** @test */
    public function user_must_be_guest()
    {
        $me = factory(User::class)->create();

        $this->actingAs($me, 'web')->get('admin/password/reset')
            ->assertRedirect();

        $this->actingAs($me, 'web')->post('admin/password/email')
            ->assertRedirect();
    }

    /** @test */
    public function user_can_request_password_reset()
    {
        Notification::fake();

        $me = factory(User::class)->create(['email' => 'johndoe@example.com']);

        $response = $this->from('admin/password/reset')->post('admin/password/email', [
            'email' => 'johndoe@example.com',
        ]);

        $response->assertRedirect('admin/password/reset');
        $response->assertSessionHasFlashMessage('success');

        Notification::assertSentTo($me, ResetPasswordNotification::class);
    }

    /** @test */
    public function email_is_required()
    {
        $data = ['email' => null];

        $response = $this->post('admin/password/email', $data);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function email_must_be_valid_email_address()
    {
        $data = ['email' => 'not-a-valid-email'];

        $response = $this->post('admin/password/email', $data);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function email_must_exist()
    {
        factory(User::class)->create(['email' => 'johndoe@example.com']);
        $data = ['email' => 'johndoe@gmail.com'];

        $response = $this->post('admin/password/email', $data);

        $response->assertSessionHasErrors('email');
    }
}
