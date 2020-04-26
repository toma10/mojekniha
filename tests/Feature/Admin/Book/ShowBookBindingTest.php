<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\BookBinding;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class ShowBookBindingTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();
        $bookBinding = factory(BookBinding::class)->create();

        $this->get("admin/books/book-bindings/{$bookBinding->id}")
            ->assertRedirect();

        $this->actingAs($user, 'web')->get("admin/books/book-bindings/{$bookBinding->id}")
            ->assertRedirect();
    }

    /** @test */
    public function viewing_show_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        $bookBinding = factory(BookBinding::class)->create();

        $response = $this->actingAs($admin, 'web')->get("admin/books/book-bindings/{$bookBinding->id}");

        $response
            ->assertOk()
            ->assertHasProp('bookBinding')
            ->assertPropValue('bookBinding', function ($givenBookBinding) use ($bookBinding) {
                $this->assertEquals($bookBinding->id, $givenBookBinding['id']);
            });
    }
}
