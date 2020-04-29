<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Book;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class ShowBookTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();
        $book = factory(Book::class)->create();

        $this->get("admin/books/books/{$book->id}")
            ->assertRedirect();

        $this->actingAs($user, 'web')->get("admin/books/books/{$book->id}")
            ->assertRedirect();
    }

    /** @test */
    public function viewing_show_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        $book = factory(Book::class)->create();

        $response = $this->actingAs($admin, 'web')->get("admin/books/books/{$book->id}");

        $response
            ->assertOk()
            ->assertHasProp('book')
            ->assertPropValue('book', function ($givenBook) use ($book) {
                $this->assertEquals($book->id, $givenBook['id']);
            });
    }
}
