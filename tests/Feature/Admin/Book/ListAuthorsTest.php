<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Author;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class ListAuthorsTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();

        $this->get('admin/books/authors')
            ->assertRedirect();

        $this->actingAs($user, 'web')->get('admin/books/authors')
            ->assertRedirect();
    }

    /** @test */
    public function viewing_index_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        factory(Author::class, 3)->create();

        $response = $this->actingAs($admin, 'web')->get('admin/books/authors');

        $response
            ->assertOk()
            ->assertPropCount('authors.data', 3)
            ->assertPropCount('authors.links.pages', 1);
    }
}
