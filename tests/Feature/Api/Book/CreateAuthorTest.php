<?php

namespace Tests\Feature\Api\Book;

use App\Domain\Book\Models\Author;
use App\Domain\Book\Models\Nationality;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CreateAuthorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_an_author()
    {
        $nationality = factory(Nationality::class)->create(['name' => 'americká']);
        $data = [
            'name' => 'Joseph Heller',
            'birth_date' => '1923-05-01',
            'death_date' => '1999-12-12',
            'biography' => 'Psal satirická díla, zejména novely a dramata.',
            'nationality_id' => $nationality->id,
        ];

        $response = $this->postJson('api/authors', $data);

        $response->assertCreated();
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
    public function portrait_image_path_is_returned_if_portrait_image_is_included()
    {
        Storage::fake('public');

        $file = File::image('portrait-image.jpg', $width = 400);
        $data = factory(Author::class)->raw(['portrait_image' => $file]);

        $response = $this->postJson('api/authors', $data);

        $this->assertNotNull($author = Author::first());
        $response->assertJson([
            'data' => [
                'portrait_image_path' => $author->getFirstMediaUrl('portrait-image'),
            ],
        ]);
    }

    /** @test */
    public function it_requires_a_name()
    {
        $data = factory(Author::class)->raw(['name' => null]);

        $response = $this->postJson('api/authors', $data);

        $response->assertJsonValidationErrors('name');
    }

    /** @test */
    public function it_requires_a_birth_date()
    {
        $data = factory(Author::class)->raw(['birth_date' => null]);

        $response = $this->postJson('api/authors', $data);

        $response->assertJsonValidationErrors('birth_date');
    }

    /** @test */
    public function birth_date_must_be_valid_date()
    {
        $data = factory(Author::class)->raw(['birth_date' => 'not-a-valid-date']);

        $response = $this->postJson('api/authors', $data);

        $response->assertJsonValidationErrors('birth_date');
    }

    /** @test */
    public function death_date_is_optional()
    {
        $data = factory(Author::class)->raw(['death_date' => null]);

        $response = $this->postJson('api/authors', $data);

        $response->assertJsonMissingValidationErrors('death_date');
    }

    /** @test */
    public function death_date_must_be_valid_date()
    {
        $data = factory(Author::class)->raw(['death_date' => 'not-a-valid-date']);

        $response = $this->postJson('api/authors', $data);

        $response->assertJsonValidationErrors('death_date');
    }

    /** @test */
    public function biography_is_optional()
    {
        $data = factory(Author::class)->raw(['biography' => null]);

        $response = $this->postJson('api/authors', $data);

        $response->assertJsonMissingValidationErrors('biography');
    }

    /** @test */
    public function biography_must_be_string()
    {
        $data = factory(Author::class)->raw(['biography' => 123]);

        $response = $this->postJson('api/authors', $data);

        $response->assertJsonValidationErrors('biography');
    }

    /** @test */
    public function it_requires_a_nationality_id()
    {
        $data = factory(Author::class)->raw(['nationality_id' => null]);

        $response = $this->postJson('api/authors', $data);

        $response->assertJsonValidationErrors('nationality_id');
    }

    /** @test */
    public function nationality_id_must_exist()
    {
        $data = factory(Author::class)->raw(['nationality_id' => 999]);

        $response = $this->postJson('api/authors', $data);

        $response->assertJsonValidationErrors('nationality_id');
    }

    /** @test */
    public function portrait_image_must_be_an_image()
    {
        Storage::fake('public');

        $file = File::create('not-a-valid-image.pdf');
        $data = factory(Author::class)->raw(['portrait_image' => $file]);

        $response = $this->postJson('api/authors', $data);

        $response->assertJsonValidationErrors('portrait_image');
    }

    /** @test */
    public function portrait_image_must_be_a_jpg()
    {
        Storage::fake('public');

        $file = File::image('not-a-jpg-image.png', $width = 400);
        $data = factory(Author::class)->raw(['portrait_image' => $file]);

        $response = $this->postJson('api/authors', $data);
        $response->assertJsonValidationErrors('portrait_image');
    }

    /** @test */
    public function portrait_image_must_be_at_least_400px_wide()
    {
        Storage::fake('public');

        $file = File::image('portrait-image.jpg', $width = 399);
        $data = factory(Author::class)->raw(['portrait_image' => $file]);

        $response = $this->postJson('api/authors', $data);

        $response->assertJsonValidationErrors('portrait_image');
    }

    /** @test */
    public function portrait_image_is_optional()
    {
        $data = factory(Author::class)->raw(['portrait_image' => null]);

        $response = $this->postJson('api/authors', $data);

        $response->assertJsonMissingValidationErrors('portrait_image');
    }
}
