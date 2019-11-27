<?php

namespace Tests\Unit\Actions;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Language;
use App\Actions\CreateEditionAction;
use App\DataTransferObjects\EditionData;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateEditionActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_an_edition()
    {
        $book = factory(Book::class)->create();
        $language = factory(Language::class)->create();
        $editionData = new EditionData([
            'book_id' => $book->id,
            'isbn' => '978-80-7381-931-6',
            'release_year' => 2011,
            'language_id' => $language->id,
            'number_of_pages' => 536,
            'number_of_copies' => 1000,
        ]);

        $edition = (new CreateEditionAction())->execute($editionData);

        $this->assertEquals($editionData->book_id, $edition->book_id);
        $this->assertEquals($editionData->isbn, $edition->isbn);
        $this->assertEquals($editionData->release_year, $edition->release_year);
        $this->assertEquals($editionData->language_id, $edition->language_id);
        $this->assertEquals($editionData->number_of_pages, $edition->number_of_pages);
        $this->assertEquals($editionData->number_of_copies, $edition->number_of_copies);
    }
}
