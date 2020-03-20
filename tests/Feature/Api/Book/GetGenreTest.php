<?php

namespace Tests\Feature\Api\Book;

use App\Domain\Book\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
