<?php

namespace Tests\Feature;

use App\Models\Tag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
}
