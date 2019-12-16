<?php

namespace Tests\Feature\Book;

use App\Domain\Book\Models\Series;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteSeriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_the_series()
    {
        $series = factory(Series::class)->create();

        $response = $this->deleteJson("api/series/{$series->id}");

        $response->assertOk();
    }

    /** @test */
    public function it_404s_if_invalid_id_is_provided()
    {
        $response = $this->deleteJson('api/series/999');

        $response->assertNotFound();
    }
}
