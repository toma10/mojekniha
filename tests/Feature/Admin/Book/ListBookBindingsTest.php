<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\BookBinding;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class ListBookBindingsTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();

        $this->get('admin/books/book-bindings')
            ->assertRedirect();

        $this->actingAs($user, 'web')->get('admin/books/book-bindings')
            ->assertRedirect();
    }

    /** @test */
    public function viewing_index_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        factory(BookBinding::class, 3)->create();

        $response = $this->actingAs($admin, 'web')->get('admin/books/book-bindings');

        $response
            ->assertOk()
            ->assertPropCount('bookBindings.data', 3)
            ->assertPropCount('bookBindings.links.pages', 1);
    }
}
