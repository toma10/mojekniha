<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateAuthorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_an_author()
    {
        $data = [
            'name' => 'Joseph Heller',
            'birth_date' => '1923-05-01',
            'death_date' => '1999-12-12',
            'biography' => 'Psal satirická díla, zejména novely a dramata.',
        ];

        $response = $this->postJSon('api/authors', $data);

        $response->assertCreated();
        $response->assertJsonStructure(['data' => ['id']]);
        $response->assertJson([
            'data' => [
                'name' => $data['name'],
                'birth_date' => $data['birth_date'],
                'death_date' => $data['death_date'],
                'biography' => $data['biography'],
            ],
        ]);
    }

    /** @test */
    public function it_requires_a_name()
    {
        $data = factory(Author::class)->raw(['name' => null]);

        $response = $this->postJSon('api/authors', $data);

        $response->assertJsonValidationErrors('name');
    }

    /** @test */
    public function it_requires_a_birth_date()
    {
        $data = factory(Author::class)->raw(['birth_date' => null]);

        $response = $this->postJSon('api/authors', $data);

        $response->assertJsonValidationErrors('birth_date');
    }

    /** @test */
    public function birth_date_must_be_valid_date()
    {
        $data = factory(Author::class)->raw(['birth_date' => 'not-a-valid-date']);

        $response = $this->postJSon('api/authors', $data);

        $response->assertJsonValidationErrors('birth_date');
    }

    /** @test */
    public function death_date_is_optional()
    {
        $data = factory(Author::class)->raw(['death_date' => null]);

        $response = $this->postJSon('api/authors', $data);

        $response->assertJsonMissingValidationErrors('death_date');
    }

    /** @test */
    public function death_date_must_be_valid_date()
    {
        $data = factory(Author::class)->raw(['death_date' => 'not-a-valid-date']);

        $response = $this->postJSon('api/authors', $data);

        $response->assertJsonValidationErrors('death_date');
    }

    /** @test */
    public function biography_is_optional()
    {
        $data = factory(Author::class)->raw(['biography' => null]);

        $response = $this->postJSon('api/authors', $data);

        $response->assertJsonMissingValidationErrors('biography');
    }

    /** @test */
    public function biography_must_be_string()
    {
        $data = factory(Author::class)->raw(['biography' => 123]);

        $response = $this->postJSon('api/authors', $data);

        $response->assertJsonValidationErrors('biography');
    }
}
