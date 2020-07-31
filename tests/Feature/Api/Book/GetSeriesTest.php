<?php

namespace Tests\Feature\Api\Book;

use App\Domain\Book\Models\Author;
use App\Domain\Book\Models\Nationality;
use App\Domain\Book\Models\Series;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetSeriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_the_series()
    {
        $nationality = factory(Nationality::class)->create();
        $author = factory(Author::class)->create(['nationality_id' => $nationality]);
        $series = factory(Series::class)->create(['author_id' => $author]);

        $response = $this->getJson("api/series/{$series->id}");

        $response->assertOk();
        $response->assertExactJson([
            'data' => [
                'id' => $series->id,
                'name' => $series->name,
                'author' => [
                    'id' => $author->id,
                    'name' => $author->name,
                    'birth_date' => $author->birth_date->format('Y-m-d'),
                    'death_date' => $author->death_date->format('Y-m-d'),
                    'biography' => $author->biography,
                    'formatted_biography' => sprintf('<p>%s</p>', $author->biography),
                    'nationality' => [
                        'id' => $nationality->id,
                        'name' => $nationality->name,
                    ],
                    'portrait_url' => url(Author::FALLBACK_PORTRAIT_IMAGE),
                ],
                'books' => [],
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
