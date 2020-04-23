<?php

namespace Tests\Feature\Admin\Users;

use App\Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class ListUsersTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();

        $this->get('admin/users')
            ->assertRedirect();

        $this->actingAs($user, 'web')->get('admin/users')
            ->assertRedirect();
    }

    /** @test */
    public function viewing_index_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        factory(User::class, 19)->create();

        $response = $this->actingAs($admin, 'web')->get('admin/users');

        $response
            ->assertOk()
            ->assertPropCount('users.data', 15)
            ->assertPropCount('users.links.pages', 2);
    }
}
