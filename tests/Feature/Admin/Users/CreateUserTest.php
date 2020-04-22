<?php

namespace Tests\Feature\Admin\Users;

use App\Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class CreateUserTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();

        $this->get('admin/users/create')
            ->assertRedirect();

        $this->actingAs($user, 'web')->get('admin/users/create')
            ->assertRedirect();
    }

    /** @test */
    public function viewing_create_page()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin, 'web')->get('admin/users/create')
            ->assertOk();
    }

    /** @test */
    public function it_creates_the_user()
    {
        $admin = factory(User::class)->states('admin')->create();

        $data = [
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
        ];

        $response = $this->actingAs($admin, 'web')->post('admin/users', $data);

        $response
            ->assertRedirect('admin/users')
            ->assertSessionHasFlashMessage('success');
    }

    /** @test */
    public function name_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->create();
        $data = factory(User::class)->raw(['name' => null]);

        $response = $this->actingAs($admin, 'web')->post('admin/users', $data);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function username_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->create();
        $data = factory(User::class)->raw(['username' => null]);

        $response = $this->actingAs($admin, 'web')->post('admin/users', $data);

        $response->assertSessionHasErrors('username');
    }

    /** @test */
    public function username_must_be_unique()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->create();
        factory(User::class)->create(['username' => 'johndoe']);
        $data = factory(User::class)->raw(['username' => 'johndoe']);

        $response = $this->actingAs($admin, 'web')->post('admin/users', $data);

        $response->assertSessionHasErrors('username');
    }

    /** @test */
    public function email_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->create();
        $data = factory(User::class)->raw(['email' => null]);

        $response = $this->actingAs($admin, 'web')->post('admin/users', $data);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function email_must_be_valid_email()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->create();
        $data = factory(User::class)->raw(['email' => 'not-a-valid-email']);

        $response = $this->actingAs($admin, 'web')->post('admin/users', $data);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function email_must_be_unique()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->create();
        factory(User::class)->create(['email' => 'johndoe@example.com']);
        $data = factory(User::class)->raw(['email' => 'johndoe@example.com']);

        $response = $this->actingAs($admin, 'web')->post('admin/users', $data);

        $response->assertSessionHasErrors('email');
    }
}
