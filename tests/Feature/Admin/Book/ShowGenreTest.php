<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Genre;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class ShowGenreTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();
        $genre = factory(Genre::class)->create();

        $this->get("admin/books/genres/{$genre->id}")
            ->assertRedirect();

        $this->actingAs($user, 'web')->get("admin/books/genres/{$genre->id}")
            ->assertRedirect();
    }

    /** @test */
    public function viewing_show_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        $genre = factory(Genre::class)->create();

        $response = $this->actingAs($admin, 'web')->get("admin/books/genres/{$genre->id}");

        $response
            ->assertOk()
            ->assertHasProp('genre')
            ->assertPropValue('genre', function ($givenGenre) use ($genre) {
                $this->assertEquals($genre->id, $givenGenre['id']);
            });
    }
}
