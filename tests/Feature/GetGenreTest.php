<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetGenreTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_the_genre()
    {
        $genre = factory(Genre::class)->create();

        $response = $this->getJson("api/genres/{$genre->id}");

        $response->assertOk();
        $response->assertExactJson([
            'data' => [
                'id' => $genre->id,
                'name' => $genre->name,
            ],
        ]);
    }

    /** @test */
    public function it_404s_if_invalid_id_is_provided()
    {
        $response = $this->getJson('api/genres/999');

        $response->assertNotFound();
    }
}
