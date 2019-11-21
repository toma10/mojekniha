<?php

namespace Tests\Feature;

use App\Models\Tag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTagTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_tag()
    {
        $data = [
            'name' => 'zfilmovano',
        ];

        $response = $this->postJSon('api/tags', $data);

        $response->assertCreated();
        $response->assertJsonStructure(['data' => ['id']]);
        $response->assertJson([
            'data' => [
                'name' => $data['name'],
            ],
        ]);
    }

    /** @test */
    public function it_requires_a_name()
    {
        $data = factory(Tag::class)->raw(['name' => null]);

        $response = $this->postJSon('api/tags', $data);

        $response->assertJsonValidationErrors('name');
    }

    /** @test */
    public function name_must_be_unique()
    {
        factory(Tag::class)->create(['name' => 'zfilmovano']);
        $data = factory(Tag::class)->raw(['name' => 'zfilmovano']);

        $response = $this->postJSon('api/tags', $data);

        $response->assertJsonValidationErrors('name');
    }
}