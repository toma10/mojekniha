<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Author;
use App\Models\Nationality;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateAuthorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_the_author()
    {
        $author = factory(Author::class)->create();
        $nationality = factory(Nationality::class)->create(['name' => 'americká']);

        $data = [
            'name' => 'Joseph Heller',
            'birth_date' => '1923-05-01',
            'death_date' => '1999-12-12',
            'biography' => 'Psal satirická díla, zejména novely a dramata.',
            'nationality_id' => $nationality->id,
        ];

        $response = $this->putJson("api/authors/{$author->id}", $data);

        $response->assertOk();
        $response->assertJsonStructure(['data' => ['id']]);
        $response->assertJson([
            'data' => [
                'name' => $data['name'],
                'birth_date' => $data['birth_date'],
                'death_date' => $data['death_date'],
                'biography' => $data['biography'],
                'nationality' => [
                    'id' => $nationality->id,
                    'name' => $nationality->name,
                ],
            ],
        ]);
    }

    /** @test */
    public function it_404s_if_invalid_id_is_provided()
    {
        $response = $this->putJson('api/authors/999', []);

        $response->assertNotFound();
    }

    /** @test */
    public function it_requires_a_name()
    {
        $author = factory(Author::class)->create();
        $data = factory(Author::class)->raw(['name' => null]);

        $response = $this->putJson("api/authors/{$author->id}", $data);

        $response->assertJsonValidationErrors('name');
    }

    /** @test */
    public function it_requires_a_birth_date()
    {
        $author = factory(Author::class)->create();
        $data = factory(Author::class)->raw(['birth_date' => null]);

        $response = $this->putJson("api/authors/{$author->id}", $data);

        $response->assertJsonValidationErrors('birth_date');
    }

    /** @test */
    public function birth_date_must_be_valid_date()
    {
        $author = factory(Author::class)->create();
        $data = factory(Author::class)->raw(['birth_date' => 'not-a-valid-date']);

        $response = $this->putJson("api/authors/{$author->id}", $data);

        $response->assertJsonValidationErrors('birth_date');
    }

    /** @test */
    public function death_date_is_optional()
    {
        $author = factory(Author::class)->create();
        $data = factory(Author::class)->raw(['death_date' => null]);

        $response = $this->putJson("api/authors/{$author->id}", $data);

        $response->assertJsonMissingValidationErrors('death_date');
        $this->assertNull($author->fresh()->death_date);
    }

    /** @test */
    public function death_date_must_be_valid_date()
    {
        $author = factory(Author::class)->create();
        $data = factory(Author::class)->raw(['death_date' => 'not-a-valid-date']);

        $response = $this->putJson("api/authors/{$author->id}", $data);

        $response->assertJsonValidationErrors('death_date');
    }

    /** @test */
    public function biography_is_optional()
    {
        $author = factory(Author::class)->create();
        $data = factory(Author::class)->raw(['biography' => null]);

        $response = $this->putJson("api/authors/{$author->id}", $data);

        $response->assertJsonMissingValidationErrors('biography');
        $this->assertNull($author->fresh()->biography);
    }

    /** @test */
    public function biography_must_be_string()
    {
        $author = factory(Author::class)->create();
        $data = factory(Author::class)->raw(['biography' => 123]);

        $response = $this->putJson("api/authors/{$author->id}", $data);

        $response->assertJsonValidationErrors('biography');
    }

    /** @test */
    public function it_requires_a_nationality_id()
    {
        $author = factory(Author::class)->create();
        $data = factory(Author::class)->raw(['nationality_id' => null]);

        $response = $this->putJson("api/authors/{$author->id}", $data);

        $response->assertJsonValidationErrors('nationality_id');
    }

    /** @test */
    public function nationality_id_must_exist()
    {
        $author = factory(Author::class)->create();
        $data = factory(Author::class)->raw(['nationality_id' => 999]);

        $response = $this->putJson("api/authors/{$author->id}", $data);

        $response->assertJsonValidationErrors('nationality_id');
    }
}
