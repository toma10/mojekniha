<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateGenreTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_genre()
    {
        $data = [
            'name' => 'Romány',
        ];

        $response = $this->postJSon('api/genres', $data);

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
        $data = factory(Genre::class)->raw(['name' => null]);

        $response = $this->postJSon('api/genres', $data);

        $response->assertJsonValidationErrors('name');
    }
}
