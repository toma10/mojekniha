<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteGenreTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_the_genre()
    {
        $genre = factory(Genre::class)->create();

        $response = $this->deleteJson("api/genres/{$genre->id}");

        $response->assertOk();
    }

    /** @test */
    public function it_404s_if_invalid_id_is_provided()
    {
        $response = $this->deleteJson('api/genres/999');

        $response->assertNotFound();
    }
}
