<?php

namespace Tests\Feature\Admin\User;

use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class DeleteUserTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();

        $this->delete("admin/users/{$user->id}")
            ->assertRedirect();

        $this->actingAs($user, 'web')->delete("admin/users/{$user->id}")
            ->assertRedirect();
    }

    /** @test */
    public function it_deletes_the_book()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->create();

        $response = $this->actingAs($admin, 'web')->delete("admin/users/{$user->id}");

        $response
            ->assertRedirect('admin/users')
            ->assertSessionHasFlashMessage('success');
    }
}
