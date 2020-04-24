<?php

namespace Tests\Feature\Admin\User;

use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class UpdateProfileTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();
        $anotherUser = factory(User::class)->create();

        $this->get('admin/profile')
            ->assertRedirect();

        $this->actingAs($user, 'web')->get('admin/profile')
            ->assertRedirect();
    }

    /** @test */
    public function viewing_profile_page()
    {
        $admin = factory(User::class)->states('admin')->create();

        $response = $this->actingAs($admin, 'web')->get('admin/profile');

        $response
            ->assertOk()
            ->assertHasProp('user')
            ->assertPropValue('user', function ($user) use ($admin) {
                $this->assertEquals($admin->id, $user['id']);
            });
    }

    /** @test */
    public function it_updates_the_user()
    {
        $admin = factory(User::class)->states('admin')->create();

        $data = [
            'name' => 'John Doe',
            'username' => 'johndoe',
        ];

        $response = $this->from('admin/profile')->actingAs($admin, 'web')->post('admin/profile', $data);

        $response
            ->assertRedirect('admin/profile')
            ->assertSessionHasFlashMessage('success');
    }

    /** @test */
    public function name_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(User::class)->raw(['name' => null]);

        $response = $this->actingAs($admin, 'web')->post('admin/profile', $data);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function username_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(User::class)->raw(['username' => null]);

        $response = $this->actingAs($admin, 'web')->post('admin/profile', $data);

        $response->assertSessionHasErrors('username');
    }

    /** @test */
    public function username_must_be_unique()
    {
        $admin = factory(User::class)->states('admin')->create();
        factory(User::class)->create(['username' => 'johndoe']);
        $data = factory(User::class)->raw(['username' => 'johndoe']);

        $response = $this->actingAs($admin, 'web')->post('admin/profile', $data);

        $response->assertSessionHasErrors('username');
    }

    /** @test */
    public function user_can_t_change_email()
    {
        $admin = factory(User::class)->states('admin')->create(['email' => 'johndoe@example.com']);
        $data = factory(User::class)->raw(['email' => 'johndoe@gmail.com']);

        $response = $this->from('admin/profile')->actingAs($admin, 'web')->post('admin/profile', $data);

        $response
            ->assertRedirect('admin/profile')
            ->assertSessionHasFlashMessage('success');
        $this->assertEquals('johndoe@example.com', $admin->fresh()->email);
    }
}
