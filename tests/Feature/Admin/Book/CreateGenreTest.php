<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Genre;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class CreateGenreTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();

        $this->get('admin/books/genres/create')
            ->assertRedirect();

        $this->actingAs($user, 'web')->get('admin/books/genres/create')
            ->assertRedirect();
    }

    /** @test */
    public function viewing_create_page()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin, 'web')->get('admin/books/genres/create')
            ->assertOk();
    }

    /** @test */
    public function it_creates_the_genre()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = ['name' => 'Horror'];

        $response = $this->actingAs($admin, 'web')->post('admin/books/genres', $data);

        $response
            ->assertRedirect('admin/books/genres')
            ->assertSessionHasFlashMessage('success');
    }

    /** @test */
    public function name_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Genre::class)->raw(['name' => null]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/genres', $data);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function name_must_be_unique()
    {
        $admin = factory(User::class)->states('admin')->create();
        factory(Genre::class)->create(['name' => 'Horror']);
        $data = factory(Genre::class)->raw(['name' => 'Horror']);

        $response = $this->actingAs($admin, 'web')->post('admin/books/genres', $data);

        $response->assertSessionHasErrors('name');
    }
}
