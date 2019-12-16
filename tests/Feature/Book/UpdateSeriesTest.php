<?php

namespace Tests\Feature\Book;

use App\Domain\Book\Models\Author;
use App\Domain\Book\Models\Series;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateSeriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_the_series()
    {
        $series = factory(Series::class)->create();
        $author = factory(Author::class)->create();
        $data = [
            'name' => 'Hlava XXII',
            'author_id' => $author->id,
        ];

        $response = $this->putJson("api/series/{$series->id}", $data);

        $response->assertOk();
        $response->assertExactJson([
            'data' => [
                'id' => $series['id'],
                'name' => $data['name'],
            ],
        ]);
    }

    /** @test */
    public function it_404s_if_invalid_id_is_provided()
    {
        $response = $this->putJson('api/series/999', []);

        $response->assertNotFound();
    }

    /** @test */
    public function it_requires_a_name()
    {
        $series = factory(Series::class)->create();
        $data = factory(Series::class)->raw(['name' => null]);

        $response = $this->putJson("api/series/{$series->id}", $data);

        $response->assertJsonValidationErrors('name');
    }

    /** @test */
    public function it_requires_an_author_id()
    {
        $series = factory(Series::class)->create();
        $data = factory(Series::class)->raw(['author_id' => null]);

        $response = $this->putJson("api/series/{$series->id}", $data);

        $response->assertJsonValidationErrors('author_id');
    }

    /** @test */
    public function author_id_must_exist()
    {
        $series = factory(Series::class)->create();
        $data = factory(Series::class)->raw(['author_id' => 999]);

        $response = $this->putJson("api/series/{$series->id}", $data);

        $response->assertJsonValidationErrors('author_id');
    }
}
