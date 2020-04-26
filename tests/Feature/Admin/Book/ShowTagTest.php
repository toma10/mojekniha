<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Tag;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class ShowTagTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();
        $tag = factory(Tag::class)->create();

        $this->get("admin/books/tags/{$tag->id}")
            ->assertRedirect();

        $this->actingAs($user, 'web')->get("admin/books/tags/{$tag->id}")
            ->assertRedirect();
    }

    /** @test */
    public function viewing_show_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        $tag = factory(Tag::class)->create();

        $response = $this->actingAs($admin, 'web')->get("admin/books/tags/{$tag->id}");

        $response
            ->assertOk()
            ->assertHasProp('tag')
            ->assertPropValue('tag', function ($givenTag) use ($tag) {
                $this->assertEquals($tag->id, $givenTag['id']);
            });
    }
}
