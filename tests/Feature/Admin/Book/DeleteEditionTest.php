<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Edition;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class DeleteEditionTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();
        $edition = factory(Edition::class)->create();

        $this->delete("admin/books/editions/{$edition->id}")
            ->assertRedirect();

        $this->actingAs($user, 'web')->delete("admin/books/editions/{$edition->id}")
            ->assertRedirect();
    }

    /** @test */
    public function it_deletes_the_edition()
    {
        $admin = factory(User::class)->states('admin')->create();
        $edition = factory(Edition::class)->create();

        $response = $this->actingAs($admin, 'web')->delete("admin/books/editions/{$edition->id}");

        $response
            ->assertRedirect('admin/books/editions')
            ->assertSessionHasFlashMessage('success');
    }
}
