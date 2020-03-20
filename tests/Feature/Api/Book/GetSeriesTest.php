<?php

namespace Tests\Feature\Api\Book;

use App\Domain\Book\Models\Series;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetSeriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_the_series()
    {
        $series = factory(Series::class)->create();

        $response = $this->getJson("api/series/{$series->id}");

        $response->assertOk();
        $response->assertExactJson([
            'data' => [
                'id' => $series->id,
                'name' => $series->name,
            ],
        ]);
    }

    /** @test */
    public function it_404s_if_invalid_id_is_provided()
    {
        $response = $this->getJson('api/series/999');

        $response->assertNotFound();
    }
}
