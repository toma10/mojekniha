<?php

namespace Tests\Unit\Actions;

use App\Actions\UpdateBookAction;
use App\Actions\UploadBookCoverImageAction;
use App\DataTransferObjects\BookData;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Mockery;
use Tests\TestCase;

class UpdateBookActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_the_book()
    {
        $book = factory(Book::class)->create();
        $author = factory(Author::class)->create();
        $bookData = new BookData([
            'name' => 'Hlava XXII',
            'original_name' => 'Catch-22',
            'description' => 'Hlavní postavou je poručík letectva Yossarian, který je trochu klaun a trochu blázen.',
            'release_year' => 1961,
            'author_id' => $author->id,
        ]);

        $book = app(UpdateBookAction::class)->execute($book, $bookData);

        $this->assertEquals($bookData->name, $book->name);
        $this->assertEquals($bookData->original_name, $book->original_name);
        $this->assertEquals($bookData->description, $book->description);
        $this->assertEquals($bookData->release_year, $book->release_year);
        $this->assertEquals($bookData->author_id, $book->author_id);
    }

    /** @test */
    public function upload_book_cover_image_action_is_called_if_cover_image_is_included()
    {
        Storage::fake('public');

        $book = factory(Book::class)->create();
        $author = factory(Author::class)->create();
        $file = File::image('cover-image.jpg');
        $bookData = new BookData([
            'name' => 'Hlava XXII',
            'original_name' => 'Catch-22',
            'description' => 'Hlavní postavou je poručík letectva Yossarian, který je trochu klaun a trochu blázen.',
            'release_year' => 1961,
            'author_id' => $author->id,
            'cover_image' => $file,
        ]);

        $uploadBookCoverImageAction = $this->mock(UploadBookCoverImageAction::class);
        $uploadBookCoverImageAction
            ->shouldReceive()
            ->execute(Mockery::type(Book::class), Mockery::on(function ($uploadedFile) use ($file) {
                return $file === $uploadedFile;
            }))
            ->once();

        app(UpdateBookAction::class)->execute($book, $bookData);
    }
}
