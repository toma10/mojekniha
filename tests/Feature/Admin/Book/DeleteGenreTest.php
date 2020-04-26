<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Genre;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class DeleteGenreTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();
        $genre = factory(Genre::class)->create();

        $this->delete("admin/books/genres/{$genre->id}")
            ->assertRedirect();

        $this->actingAs($user, 'web')->delete("admin/books/genres/{$genre->id}")
            ->assertRedirect();
    }

    /** @test */
    public function it_deletes_the_genre()
    {
        $admin = factory(User::class)->states('admin')->create();
        $genre = factory(Genre::class)->create();

        $response = $this->actingAs($admin, 'web')->delete("admin/books/genres/{$genre->id}");

        $response
            ->assertRedirect('admin/books/genres')
            ->assertSessionHasFlashMessage('success');
    }
}
