<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Tag;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class CreateTagTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();

        $this->get('admin/books/tags/create')
            ->assertRedirect();

        $this->actingAs($user, 'web')->get('admin/books/tags/create')
            ->assertRedirect();
    }

    /** @test */
    public function viewing_create_page()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin, 'web')->get('admin/books/tags/create')
            ->assertOk();
    }

    /** @test */
    public function it_creates_a_tag()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = ['name' => 'romance'];

        $response = $this->actingAs($admin, 'web')->post('admin/books/tags', $data);

        $response
            ->assertRedirect('admin/books/tags')
            ->assertSessionHasFlashMessage('success');
    }

    /** @test */
    public function name_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Tag::class)->raw(['name' => null]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/tags', $data);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function name_must_be_unique()
    {
        $admin = factory(User::class)->states('admin')->create();
        factory(Tag::class)->create(['name' => 'romance']);
        $data = factory(Tag::class)->raw(['name' => 'romance']);

        $response = $this->actingAs($admin, 'web')->post('admin/books/tags', $data);

        $response->assertSessionHasErrors('name');
    }
}
