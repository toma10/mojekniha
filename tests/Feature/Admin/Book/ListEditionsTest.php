<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Edition;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class ListEditionsTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();

        $this->get('admin/books/editions')
            ->assertRedirect();

        $this->actingAs($user, 'web')->get('admin/books/editions')
            ->assertRedirect();
    }

    /** @test */
    public function viewing_index_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        factory(Edition::class, 3)->create();

        $response = $this->actingAs($admin, 'web')->get('admin/books/editions');

        $response
            ->assertOk()
            ->assertPropCount('editions.data', 3)
            ->assertPropCount('editions.links.pages', 1);
    }
}
