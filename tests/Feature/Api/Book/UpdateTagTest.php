<?php

namespace Tests\Feature\Api\Book;

use App\Domain\Book\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTagTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_the_tag()
    {
        $tag = factory(Tag::class)->create();
        $data = [
            'name' => 'zfilmovano',
        ];

        $response = $this->putJson("api/tags/{$tag->id}", $data);

        $response->assertOk();
        $response->assertExactJson([
            'data' => [
                'id' => $tag['id'],
                'name' => $data['name'],
            ],
        ]);
    }

    /** @test */
    public function it_404s_if_invalid_id_is_provided()
    {
        $response = $this->putJson('api/tags/999', []);

        $response->assertNotFound();
    }

    /** @test */
    public function it_requires_a_name()
    {
        $tag = factory(Tag::class)->create();
        $data = factory(Tag::class)->raw(['name' => null]);

        $response = $this->putJson("api/tags/{$tag->id}", $data);

        $response->assertJsonValidationErrors('name');
    }

    /** @test */
    public function name_must_be_unique()
    {
        $tag = factory(Tag::class)->create(['name' => 'zfilmovano']);
        $data = factory(Tag::class)->raw(['name' => 'zfilmovano']);

        $response = $this->putJson("api/tags/{$tag->id}", $data);

        $response->assertJsonValidationErrors('name');
    }
}
