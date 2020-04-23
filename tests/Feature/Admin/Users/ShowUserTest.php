<?php

namespace Tests\Feature\Admin\Users;

use App\Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class ShowUserTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();
        $anotherUser = factory(User::class)->create();

        $this->get("admin/users/{$anotherUser->id}")
            ->assertRedirect();

        $this->actingAs($user, 'web')->get("admin/users/{$anotherUser->id}")
            ->assertRedirect();
    }

    /** @test */
    public function viewing_show_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->create();

        $response = $this->actingAs($admin, 'web')->get("admin/users/{$user->id}");

        $response
            ->assertOk()
            ->assertHasProp('user')
            ->assertPropValue('user', function ($givenUser) use ($user) {
                $this->assertEquals($user->id, $givenUser['id']);
            });
    }
}
