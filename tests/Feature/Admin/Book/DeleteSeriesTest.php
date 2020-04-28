<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Series;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class DeleteSeriesTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();
        $series = factory(Series::class)->create();

        $this->delete("admin/books/series/{$series->id}")
            ->assertRedirect();

        $this->actingAs($user, 'web')->delete("admin/books/series/{$series->id}")
            ->assertRedirect();
    }

    /** @test */
    public function it_deletes_the_series()
    {
        $admin = factory(User::class)->states('admin')->create();
        $series = factory(Series::class)->create();

        $response = $this->actingAs($admin, 'web')->delete("admin/books/series/{$series->id}");

        $response
            ->assertRedirect('admin/books/series')
            ->assertSessionHasFlashMessage('success');
    }
}
