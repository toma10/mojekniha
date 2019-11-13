<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetAuthorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_the_author()
    {
        $author = factory(Author::class)->create();

        $response = $this->getJson("api/authors/{$author->id}");

        $response->assertOk();
        $response->assertExactJson([
            'data' => [
                'id' => $author->id,
                'name' => $author->name,
                'birth_date' => $author->birth_date,
                'death_date' => $author->death_date,
                'biography' => $author->biography,
            ],
        ]);
    }

    /** @test */
    public function it_404s_if_invalid_id_is_provided()
    {
        $response = $this->getJson('api/authors/999');

        $response->assertNotFound();
    }
}
