<?php

namespace Tests\Feature;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetTagTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_the_tag()
    {
        $tag = factory(Tag::class)->create();

        $response = $this->getJson("api/tags/{$tag->id}");

        $response->assertOk();
        $response->assertExactJson([
            'data' => [
                'id' => $tag->id,
                'name' => $tag->name,
            ],
        ]);
    }

    /** @test */
    public function it_404s_if_invalid_id_is_provided()
    {
        $response = $this->getJson('api/tags/999');

        $response->assertNotFound();
    }
}
