<?php

namespace Tests\Unit\Domain\Book\Actions;

use App\Domain\Book\Actions\UpdateEditionAction;
use App\Domain\Book\Actions\UploadEditionCoverImageAction;
use App\Domain\Book\DataTransferObjects\EditionData;
use App\Domain\Book\Models\Book;
use App\Domain\Book\Models\BookBinding;
use App\Domain\Book\Models\Edition;
use App\Domain\Book\Models\Language;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Mockery;
use Tests\TestCase;

class UpdateEditionActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_the_edition()
    {
        $edition = factory(Edition::class)->create();
        $book = factory(Book::class)->create();
        $language = factory(Language::class)->create(['name' => 'český']);
        $bookBinding = factory(BookBinding::class)->create();
        $editionData = new EditionData([
            'book_id' => $book->id,
            'isbn' => '978-80-7381-931-6',
            'release_year' => 2011,
            'language_id' => $language->id,
            'number_of_pages' => 536,
            'number_of_copies' => 1000,
            'book_binding_id' => $bookBinding->id,
        ]);

        $edition = app(UpdateEditionAction::class)->execute($edition, $editionData);

        $this->assertEquals($editionData->book_id, $edition->book_id);
        $this->assertEquals($editionData->isbn, $edition->isbn);
        $this->assertEquals($editionData->release_year, $edition->release_year);
        $this->assertEquals($editionData->language_id, $edition->language_id);
        $this->assertEquals($editionData->number_of_pages, $edition->number_of_pages);
        $this->assertEquals($editionData->number_of_copies, $edition->number_of_copies);
        $this->assertEquals($editionData->book_binding_id, $edition->book_binding_id);
    }

    /** @test */
    public function upload_edition_cover_image_action_is_called_if_cover_image_is_included()
    {
        Storage::fake('public');

        $edition = factory(Edition::class)->create();
        $book = factory(Book::class)->create();
        $language = factory(Language::class)->create(['name' => 'český']);
        $bookBinding = factory(BookBinding::class)->create();
        $file = File::image('cover-image.jpg');
        $editionData = new EditionData([
            'book_id' => $book->id,
            'isbn' => '978-80-7381-931-6',
            'release_year' => 2011,
            'language_id' => $language->id,
            'number_of_pages' => 536,
            'number_of_copies' => 1000,
            'book_binding_id' => $bookBinding->id,
            'cover_image' => $file,
        ]);

        $uploadEditionCoverImageAction = $this->mock(UploadEditionCoverImageAction::class);
        $uploadEditionCoverImageAction
            ->shouldReceive()
            ->execute(Mockery::type(Edition::class), Mockery::on(function ($uploadedFile) use ($file) {
                return $file === $uploadedFile;
            }))
            ->once();

        app(UpdateEditionAction::class)->execute($edition, $editionData);
    }
}
