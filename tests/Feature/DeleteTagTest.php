<?php

namespace Tests\Feature;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTagTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_the_tag()
    {
        $tag = factory(Tag::class)->create();

        $response = $this->deleteJson("api/tags/{$tag->id}");

        $response->assertOk();
    }

    /** @test */
    public function it_404s_if_invalid_id_is_provided()
    {
        $response = $this->deleteJson('api/tags/999');

        $response->assertNotFound();
    }
}
