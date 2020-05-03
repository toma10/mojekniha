<?php

namespace Tests\Feature\Api\Book;

use App\Domain\Book\Models\BookBinding;
use App\Domain\Book\Models\Edition;
use App\Domain\Book\Models\Language;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetEditionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_the_edition_with_default_cover_url()
    {
        $language = factory(Language::class)->create();
        $bookBinding = factory(BookBinding::class)->create();
        $edition = factory(Edition::class)->create([
            'language_id' => $language,
            'book_binding_id' => $bookBinding,
        ]);

        $response = $this->getJson("api/editions/{$edition->id}");

        $response->assertOk();
        $response->assertExactJson([
            'data' => [
                'id' => $edition->id,
                'isbn' => $edition->isbn,
                'release_year' => $edition->release_year,
                'language' => [
                    'id' => $language->id,
                    'name' => $language->name,
                ],
                'number_of_pages' => $edition->number_of_pages,
                'number_of_copies' => $edition->number_of_copies,
                'book_binding' => [
                    'id' => $bookBinding->id,
                    'name' => $bookBinding->name,
                ],
                'cover_url' => url(Edition::FALLBACK_COVER_IMAGE),
            ],
        ]);
    }

    /** @test */
    public function it_404s_if_invalid_id_is_provided()
    {
        $response = $this->getJson('api/editions/999');

        $response->assertNotFound();
    }
}
