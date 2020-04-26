<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\BookBinding;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class UpdateBookBindingTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();
        $bookBinding = factory(BookBinding::class)->create();

        $this->get("admin/books/book-bindings/{$bookBinding->id}/edit")
            ->assertRedirect();

        $this->actingAs($user, 'web')->get("admin/books/book-bindings/{$bookBinding->id}/edit")
            ->assertRedirect();
    }

    /** @test */
    public function viewing_edit_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        $bookBinding = factory(BookBinding::class)->create();

        $response = $this->actingAs($admin, 'web')->get("admin/books/book-bindings/{$bookBinding->id}/edit");

        $response
            ->assertOk()
            ->assertHasProp('bookBinding')
            ->assertPropValue('bookBinding', function ($givenBookBinding) use ($bookBinding) {
                $this->assertEquals($bookBinding->id, $givenBookBinding['id']);
            });
    }

    /** @test */
    public function it_updates_the_book_binding()
    {
        $admin = factory(User::class)->states('admin')->create();
        $bookBinding = factory(BookBinding::class)->create();
        $data = ['name' => 'hardcover'];

        $response = $this->actingAs($admin, 'web')->put("admin/books/book-bindings/{$bookBinding->id}", $data);

        $response
            ->assertRedirect("admin/books/book-bindings/{$bookBinding->id}/edit")
            ->assertSessionHasFlashMessage('success');
    }

    /** @test */
    public function name_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $bookBinding = factory(BookBinding::class)->create();
        $data = factory(BookBinding::class)->raw(['name' => null]);

        $response = $this->actingAs($admin, 'web')->put("admin/books/book-bindings/{$bookBinding->id}", $data);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function name_must_be_unique()
    {
        $admin = factory(User::class)->states('admin')->create();
        $bookBinding = factory(BookBinding::class)->create();
        factory(BookBinding::class)->create(['name' => 'hardcover']);
        $data = factory(BookBinding::class)->raw(['name' => 'hardcover']);

        $response = $this->actingAs($admin, 'web')->put("admin/books/book-bindings/{$bookBinding->id}", $data);

        $response->assertSessionHasErrors('name');
    }
}
