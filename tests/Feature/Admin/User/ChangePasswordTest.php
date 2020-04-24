<?php

namespace Tests\Feature\Admin\User;

use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ChangePasswordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();

        $this->post('admin/password')
            ->assertRedirect();

        $this->actingAs($user, 'web')->post('admin/password')
            ->assertRedirect();
    }

    /** @test */
    public function it_updated_the_password()
    {
        $admin = factory(User::class)->states('admin')->create(['password' => Hash::make('password')]);
        $data = [
            'password' => 'password',
            'new_password' => 'new-password',
            'new_password_confirmation' => 'new-password',
        ];

        $response = $this->from('admin/profile')->actingAs($admin, 'web')->post('admin/password', $data);

        $response->assertRedirect('admin/profile')
            ->assertSessionHasFlashMessage('success');
    }

    /** @test */
    public function password_must_be_correct()
    {
        $admin = factory(User::class)->states('admin')->create(['password' => Hash::make('password')]);
        $data = [
            'password' => 'not-a-correct-password',
            'new_password' => 'new-password',
            'new_password_confirmation' => 'new-password',
        ];

        $response = $this->actingAs($admin, 'web')->post('admin/password', $data);

        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function it_requires_a_password()
    {
        $admin = factory(User::class)->states('admin')->create(['password' => Hash::make('password')]);
        $data = [
            'password' => null,
            'new_password' => 'new-password',
            'new_password_confirmation' => 'new-password',
        ];

        $response = $this->actingAs($admin, 'web')->post('admin/password', $data);

        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function it_requires_a_new_password()
    {
        $admin = factory(User::class)->states('admin')->create(['password' => Hash::make('password')]);
        $data = [
            'password' => 'password',
            'new_password' => null,
        ];

        $response = $this->actingAs($admin, 'web')->post('admin/password', $data);

        $response->assertSessionHasErrors('new_password');
    }

    /** @test */
    public function new_password_must_have_at_least_8_characters()
    {
        $admin = factory(User::class)->states('admin')->create(['password' => Hash::make('password')]);
        $data = [
            'password' => 'password',
            'new_password' => 'abcdefg',
            'new_password_confirmation' => 'new-password',
        ];

        $response = $this->actingAs($admin, 'web')->post('admin/password', $data);

        $response->assertSessionHasErrors('new_password');
    }

    /** @test */
    public function new_password_must_be_confirmed()
    {
        $admin = factory(User::class)->states('admin')->create(['password' => Hash::make('password')]);
        $data = [
            'password' => 'password',
            'new_password' => 'new-password',
            'new_password_confirmation' => 'secret',
        ];

        $response = $this->actingAs($admin, 'web')->post('admin/password', $data);

        $response->assertSessionHasErrors('new_password');
    }
}
