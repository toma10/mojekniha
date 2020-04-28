<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Series;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class ShowSeriesTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();
        $series = factory(Series::class)->create();

        $this->get("admin/books/series/{$series->id}")
            ->assertRedirect();

        $this->actingAs($user, 'web')->get("admin/books/series/{$series->id}")
            ->assertRedirect();
    }

    /** @test */
    public function viewing_show_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        $series = factory(Series::class)->create();

        $response = $this->actingAs($admin, 'web')->get("admin/books/series/{$series->id}");

        $response
            ->assertOk()
            ->assertHasProp('series')
            ->assertPropValue('series', function ($givenSeries) use ($series) {
                $this->assertEquals($series->id, $givenSeries['id']);
            });
    }
}
