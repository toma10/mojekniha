<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Genre;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class UpdateGenreTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();
        $genre = factory(Genre::class)->create();

        $this->get("admin/books/genres/{$genre->id}/edit")
            ->assertRedirect();

        $this->actingAs($user, 'web')->get("admin/books/genres/{$genre->id}/edit")
            ->assertRedirect();
    }

    /** @test */
    public function viewing_edit_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        $genre = factory(Genre::class)->create();

        $response = $this->actingAs($admin, 'web')->get("admin/books/genres/{$genre->id}/edit");

        $response
            ->assertOk()
            ->assertHasProp('genre')
            ->assertPropValue('genre', function ($givenGenre) use ($genre) {
                $this->assertEquals($genre->id, $givenGenre['id']);
            });
    }

    /** @test */
    public function it_updates_the_genre()
    {
        $admin = factory(User::class)->states('admin')->create();
        $genre = factory(Genre::class)->create();
        $data = ['name' => 'Horror'];

        $response = $this->actingAs($admin, 'web')->put("admin/books/genres/{$genre->id}", $data);

        $response
            ->assertRedirect("admin/books/genres/{$genre->id}/edit")
            ->assertSessionHasFlashMessage('success');
    }

    /** @test */
    public function name_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $genre = factory(Genre::class)->create();
        $data = factory(Genre::class)->raw(['name' => null]);

        $response = $this->actingAs($admin, 'web')->put("admin/books/genres/{$genre->id}", $data);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function name_must_be_unique()
    {
        $admin = factory(User::class)->states('admin')->create();
        $genre = factory(Genre::class)->create();
        factory(Genre::class)->create(['name' => 'Horror']);
        $data = factory(Genre::class)->raw(['name' => 'Horror']);

        $response = $this->actingAs($admin, 'web')->put("admin/books/genres/{$genre->id}", $data);

        $response->assertSessionHasErrors('name');
    }
}
