<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Series;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateSeriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_series()
    {
        $author = factory(Author::class)->create();
        $data = [
            'name' => 'Hlava XXII',
            'author_id' => $author->id,
        ];

        $response = $this->postJson('api/series', $data);

        $response->assertCreated();
        $response->assertJsonStructure(['data' => ['id']]);
        $response->assertJson([
            'data' => [
                'name' => $data['name'],
            ],
        ]);
    }

    /** @test */
    public function it_requires_a_name()
    {
        $data = factory(Series::class)->raw(['name' => null]);

        $response = $this->postJson('api/series', $data);

        $response->assertJsonValidationErrors('name');
    }

    /** @test */
    public function it_requires_an_author_id()
    {
        $data = factory(Series::class)->raw(['author_id' => null]);

        $response = $this->postJson('api/series', $data);

        $response->assertJsonValidationErrors('author_id');
    }

    /** @test */
    public function author_id_must_exist()
    {
        $data = factory(Series::class)->raw(['author_id' => 999]);

        $response = $this->postJson('api/series', $data);

        $response->assertJsonValidationErrors('author_id');
    }
}
