<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Author;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class ShowAuthorTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();
        $author = factory(Author::class)->create();

        $this->get("admin/books/authors/{$author->id}")
            ->assertRedirect();

        $this->actingAs($user, 'web')->get("admin/books/authors/{$author->id}")
            ->assertRedirect();
    }

    /** @test */
    public function viewing_show_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        $author = factory(Author::class)->create();

        $response = $this->actingAs($admin, 'web')->get("admin/books/authors/{$author->id}");

        $response
            ->assertOk()
            ->assertHasProp('author')
            ->assertPropValue('author', function ($givenAuthor) use ($author) {
                $this->assertEquals($author->id, $givenAuthor['id']);
            });
    }
}
