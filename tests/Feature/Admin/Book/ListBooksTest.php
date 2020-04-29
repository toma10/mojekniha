<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Book;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class ListBooksTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();

        $this->get('admin/books/books')
            ->assertRedirect();

        $this->actingAs($user, 'web')->get('admin/books/books')
            ->assertRedirect();
    }

    /** @test */
    public function viewing_index_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        factory(Book::class, 3)->create();

        $response = $this->actingAs($admin, 'web')->get('admin/books/books');

        $response
            ->assertOk()
            ->assertPropCount('books.data', 3)
            ->assertPropCount('books.links.pages', 1);
    }
}
