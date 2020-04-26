<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\BookBinding;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class CreateBookBindingTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();

        $this->get('admin/books/book-bindings/create')
            ->assertRedirect();

        $this->actingAs($user, 'web')->get('admin/books/book-bindings/create')
            ->assertRedirect();
    }

    /** @test */
    public function viewing_create_page()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin, 'web')->get('admin/books/book-bindings/create')
            ->assertOk();
    }

    /** @test */
    public function it_creates_the_book_binding()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = ['name' => 'hardcover'];

        $response = $this->actingAs($admin, 'web')->post('admin/books/book-bindings', $data);

        $response
            ->assertRedirect('admin/books/book-bindings')
            ->assertSessionHasFlashMessage('success');
    }

    /** @test */
    public function name_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(BookBinding::class)->raw(['name' => null]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/book-bindings', $data);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function name_must_be_unique()
    {
        $admin = factory(User::class)->states('admin')->create();
        factory(BookBinding::class)->create(['name' => 'hardcover']);
        $data = factory(BookBinding::class)->raw(['name' => 'hardcover']);

        $response = $this->actingAs($admin, 'web')->post('admin/books/book-bindings', $data);

        $response->assertSessionHasErrors('name');
    }
}
