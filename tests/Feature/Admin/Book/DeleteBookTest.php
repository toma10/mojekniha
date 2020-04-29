<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Book;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class DeleteBookTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();
        $book = factory(Book::class)->create();

        $this->delete("admin/books/books/{$book->id}")
            ->assertRedirect();

        $this->actingAs($user, 'web')->delete("admin/books/books/{$book->id}")
            ->assertRedirect();
    }

    /** @test */
    public function it_deletes_the_tag()
    {
        $admin = factory(User::class)->states('admin')->create();
        $book = factory(Book::class)->create();

        $response = $this->actingAs($admin, 'web')->delete("admin/books/books/{$book->id}");

        $response
            ->assertRedirect('admin/books/books')
            ->assertSessionHasFlashMessage('success');
    }
}
