<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Author;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class DeleteAuthorTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();
        $author = factory(Author::class)->create();

        $this->delete("admin/books/authors/{$author->id}")
            ->assertRedirect();

        $this->actingAs($user, 'web')->delete("admin/books/authors/{$author->id}")
            ->assertRedirect();
    }

    /** @test */
    public function it_deletes_the_author()
    {
        $admin = factory(User::class)->states('admin')->create();
        $author = factory(Author::class)->create();

        $response = $this->actingAs($admin, 'web')->delete("admin/books/authors/{$author->id}");

        $response
            ->assertRedirect('admin/books/authors')
            ->assertSessionHasFlashMessage('success');
    }
}
