<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Author;
use App\Domain\Book\Models\Series;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class CreateSeriesTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();

        $this->get('admin/books/series/create')
            ->assertRedirect();

        $this->actingAs($user, 'web')->get('admin/books/series/create')
            ->assertRedirect();
    }

    /** @test */
    public function viewing_create_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        factory(Author::class, 3)->create();

        $this->actingAs($admin, 'web')->get('admin/books/series/create')
            ->assertOk()
            ->assertPropCount('authors', 3);
    }

    /** @test */
    public function it_creates_the_series()
    {
        $admin = factory(User::class)->states('admin')->create();
        $author = factory(Author::class)->create();
        $data = [
            'name' => 'Hlava XXII',
            'author_id' => $author->id,
        ];

        $response = $this->actingAs($admin, 'web')->post('admin/books/series', $data);

        $response
            ->assertRedirect('admin/books/series')
            ->assertSessionHasFlashMessage('success');
    }

    /** @test */
    public function name_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Series::class)->raw(['name' => null]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/series', $data);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function author_id_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Series::class)->raw(['author_id' => null]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/series', $data);

        $response->assertSessionHasErrors('author_id');
    }

    /** @test */
    public function author_id_must_exist()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Series::class)->raw(['author_id' => 999]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/series', $data);

        $response->assertSessionHasErrors('author_id');
    }
}
