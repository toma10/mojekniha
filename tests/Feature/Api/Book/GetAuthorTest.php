<?php

namespace Tests\Feature\Api\Book;

use App\Domain\Book\Models\Author;
use App\Domain\Book\Models\Nationality;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetAuthorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_the_author_with_default_portrait_url()
    {
        $nationality = factory(Nationality::class)->create();
        $author = factory(Author::class)->create(['nationality_id' => $nationality]);

        $response = $this->getJson("api/authors/{$author->id}");

        $response->assertOk();
        $response->assertExactJson([
            'data' => [
                'id' => $author->id,
                'name' => $author->name,
                'birth_date' => $author->birth_date->format('Y-m-d'),
                'death_date' => $author->death_date->format('Y-m-d'),
                'biography' => $author->biography,
                'nationality' => [
                    'id' => $nationality->id,
                    'name' => $nationality->name,
                ],
                'portrait_url' => url(Author::FALLBACK_PORTRAIT_IMAGE),
                'books' => [],
                'series' => [],
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
