<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Tag;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class DeleteTagTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();
        $tag = factory(Tag::class)->create();

        $this->delete("admin/books/tags/{$tag->id}")
            ->assertRedirect();

        $this->actingAs($user, 'web')->delete("admin/books/tags/{$tag->id}")
            ->assertRedirect();
    }

    /** @test */
    public function it_deletes_the_tag()
    {
        $admin = factory(User::class)->states('admin')->create();
        $tag = factory(Tag::class)->create();

        $response = $this->actingAs($admin, 'web')->delete("admin/books/tags/{$tag->id}");

        $response
            ->assertRedirect('admin/books/tags')
            ->assertSessionHasFlashMessage('success');
    }
}
