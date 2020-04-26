<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Tag;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class ListTagsTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();

        $this->get('admin/books/tags')
            ->assertRedirect();

        $this->actingAs($user, 'web')->get('admin/books/tags')
            ->assertRedirect();
    }

    /** @test */
    public function viewing_index_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        factory(Tag::class, 3)->create();

        $response = $this->actingAs($admin, 'web')->get('admin/books/tags');

        $response
            ->assertOk()
            ->assertPropCount('tags.data', 3)
            ->assertPropCount('tags.links.pages', 1);
    }
}
