<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Author;
use App\Domain\Book\Models\Series;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class UpdateSeriesTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();
        $series = factory(Series::class)->create();

        $this->get("admin/books/series/{$series->id}/edit")
            ->assertRedirect();

        $this->actingAs($user, 'web')->get("admin/books/series/{$series->id}/edit")
            ->assertRedirect();
    }

    /** @test */
    public function viewing_edit_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        $series = factory(Series::class)->create();
        factory(Author::class, 3)->create();

        $response = $this->actingAs($admin, 'web')->get("admin/books/series/{$series->id}/edit");

        $response
            ->assertOk()
            ->assertHasProp('series')
            ->assertPropValue('series', function ($givenSeries) use ($series) {
                $this->assertEquals($series->id, $givenSeries['id']);
            })
            ->assertPropCount('authors', 4);
    }

    /** @test */
    public function it_updates_the_series()
    {
        $admin = factory(User::class)->states('admin')->create();
        $series = factory(Series::class)->create();
        $author = factory(Author::class)->create();
        $data = [
            'name' => 'Hlava XXII',
            'author_id' => $author->id,
        ];

        $response = $this->actingAs($admin, 'web')->put("admin/books/series/{$series->id}", $data);

        $response
            ->assertRedirect("admin/books/series/{$series->id}/edit")
            ->assertSessionHasFlashMessage('success');
    }

    /** @test */
    public function name_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $series = factory(Series::class)->create();
        $data = factory(Series::class)->raw(['name' => null]);

        $response = $this->actingAs($admin, 'web')->put("admin/books/series/{$series->id}", $data);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function author_id_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $series = factory(Series::class)->create();
        $data = factory(Series::class)->raw(['author_id' => null]);

        $response = $this->actingAs($admin, 'web')->put("admin/books/series/{$series->id}", $data);

        $response->assertSessionHasErrors('author_id');
    }

    /** @test */
    public function author_id_must_exist()
    {
        $admin = factory(User::class)->states('admin')->create();
        $series = factory(Series::class)->create();
        $data = factory(Series::class)->raw(['author_id' => 999]);

        $response = $this->actingAs($admin, 'web')->put("admin/books/series/{$series->id}", $data);

        $response->assertSessionHasErrors('author_id');
    }
}
