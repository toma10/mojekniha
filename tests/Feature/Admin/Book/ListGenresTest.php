<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Genre;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class ListGenresTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();

        $this->get('admin/books/genres')
            ->assertRedirect();

        $this->actingAs($user, 'web')->get('admin/books/genres')
            ->assertRedirect();
    }

    /** @test */
    public function viewing_index_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        factory(Genre::class, 3)->create();

        $response = $this->actingAs($admin, 'web')->get('admin/books/genres');

        $response
            ->assertOk()
            ->assertPropCount('genres.data', 3)
            ->assertPropCount('genres.links.pages', 1);
    }
}
