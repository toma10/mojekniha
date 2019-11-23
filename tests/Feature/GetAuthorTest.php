<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Author;
use App\Models\Nationality;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetAuthorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_the_author_with_default_portrait_image_path()
    {
        $nationality = factory(Nationality::class)->create(['name' => 'americká']);
        $author = factory(Author::class)->create(['nationality_id' => $nationality]);

        $response = $this->getJson("api/authors/{$author->id}");

        $response->assertOk();
        $response->assertExactJson([
            'data' => [
                'id' => $author->id,
                'name' => $author->name,
                'birth_date' => $author->birth_date,
                'death_date' => $author->death_date,
                'biography' => $author->biography,
                'nationality' => [
                    'id' => $nationality->id,
                    'name' => $nationality->name,
                ],
                'portrait_image_path' => public_path('/images/portrait-image.jpg'),
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
