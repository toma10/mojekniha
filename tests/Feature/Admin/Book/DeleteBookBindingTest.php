<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\BookBinding;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class DeleteBookBindingTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();
        $bookBinding = factory(BookBinding::class)->create();

        $this->delete("admin/books/book-bindings/{$bookBinding->id}")
            ->assertRedirect();

        $this->actingAs($user, 'web')->delete("admin/books/book-bindings/{$bookBinding->id}")
            ->assertRedirect();
    }

    /** @test */
    public function it_deletes_the_book_binding()
    {
        $admin = factory(User::class)->states('admin')->create();
        $bookBinding = factory(BookBinding::class)->create();

        $response = $this->actingAs($admin, 'web')->delete("admin/books/book-bindings/{$bookBinding->id}");

        $response
            ->assertRedirect('admin/books/book-bindings')
            ->assertSessionHasFlashMessage('success');
    }
}
