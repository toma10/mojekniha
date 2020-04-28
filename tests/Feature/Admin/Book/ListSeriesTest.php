<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Series;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class ListSeriesTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();

        $this->get('admin/books/series')
            ->assertRedirect();

        $this->actingAs($user, 'web')->get('admin/books/series')
            ->assertRedirect();
    }

    /** @test */
    public function viewing_index_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        factory(Series::class, 3)->create();

        $response = $this->actingAs($admin, 'web')->get('admin/books/series');

        $response
            ->assertOk()
            ->assertPropCount('series.data', 3)
            ->assertPropCount('series.links.pages', 1);
    }
}
