<?php

namespace Tests\Feature\Api\Book;

use App\Domain\Book\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateGenreTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_the_genre()
    {
        $genre = factory(Genre::class)->create();
        $data = [
            'name' => 'Romány',
        ];

        $response = $this->putJson("api/genres/{$genre->id}", $data);

        $response->assertOk();
        $response->assertExactJson([
            'data' => [
                'id' => $genre['id'],
                'name' => $data['name'],
            ],
        ]);
    }

    /** @test */
    public function it_404s_if_invalid_id_is_provided()
    {
        $response = $this->putJson('api/genres/999', []);

        $response->assertNotFound();
    }

    /** @test */
    public function it_requires_a_name()
    {
        $genre = factory(Genre::class)->create();
        $data = factory(Genre::class)->raw(['name' => null]);

        $response = $this->putJson("api/genres/{$genre->id}", $data);

        $response->assertJsonValidationErrors('name');
    }

    /** @test */
    public function name_must_be_unique()
    {
        $genre = factory(Genre::class)->create(['name' => 'Romány']);
        $data = factory(Genre::class)->raw(['name' => 'Romány']);

        $response = $this->putJson("api/genres/{$genre->id}", $data);

        $response->assertJsonValidationErrors('name');
    }
}
