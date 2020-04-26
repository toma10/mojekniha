<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Tag;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class UpdateTagTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();
        $tag = factory(Tag::class)->create();

        $this->get("admin/books/tags/{$tag->id}/edit")
            ->assertRedirect();

        $this->actingAs($user, 'web')->get("admin/books/tags/{$tag->id}/edit")
            ->assertRedirect();
    }

    /** @test */
    public function viewing_edit_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        $tag = factory(Tag::class)->create();

        $response = $this->actingAs($admin, 'web')->get("admin/books/tags/{$tag->id}/edit");

        $response
            ->assertOk()
            ->assertHasProp('tag')
            ->assertPropValue('tag', function ($givenTag) use ($tag) {
                $this->assertEquals($tag->id, $givenTag['id']);
            });
    }

    /** @test */
    public function it_updates_the_tag()
    {
        $admin = factory(User::class)->states('admin')->create();
        $tag = factory(Tag::class)->create();
        $data = ['name' => 'romance'];

        $response = $this->actingAs($admin, 'web')->put("admin/books/tags/{$tag->id}", $data);

        $response
            ->assertRedirect("admin/books/tags/{$tag->id}/edit")
            ->assertSessionHasFlashMessage('success');
    }

    /** @test */
    public function name_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $tag = factory(Tag::class)->create();
        $data = factory(Tag::class)->raw(['name' => null]);

        $response = $this->actingAs($admin, 'web')->put("admin/books/tags/{$tag->id}", $data);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function name_must_be_unique()
    {
        $admin = factory(User::class)->states('admin')->create();
        $tag = factory(Tag::class)->create();
        factory(Tag::class)->create(['name' => 'romance']);
        $data = factory(Tag::class)->raw(['name' => 'romance']);

        $response = $this->actingAs($admin, 'web')->put("admin/books/tags/{$tag->id}", $data);

        $response->assertSessionHasErrors('name');
    }
}
