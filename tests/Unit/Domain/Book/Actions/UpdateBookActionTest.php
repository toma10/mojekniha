<?php

namespace Tests\Unit\Domain\Book\Actions;

use App\Domain\Book\Actions\UpdateBookAction;
use App\Domain\Book\Actions\UploadBookCoverImageAction;
use App\Domain\Book\DataTransferObjects\BookData;
use App\Domain\Book\Models\Author;
use App\Domain\Book\Models\Book;
use App\Domain\Book\Models\Genre;
use App\Domain\Book\Models\Series;
use App\Domain\Book\Models\Tag;
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
        $series = factory(Series::class)->create();
        $genre = factory(Genre::class)->create();
        $tagA = factory(Tag::class)->create();
        $tagB = factory(Tag::class)->create();
        $bookData = new BookData([
            'name' => 'Hlava XXII',
            'original_name' => 'Catch-22',
            'description' => 'Hlavní postavou je poručík letectva Yossarian, který je trochu klaun a trochu blázen.',
            'release_year' => 1961,
            'author_id' => $author->id,
            'series_id' => $series->id,
            'genres' => [$genre->id],
            'tags' => [$tagA->id, $tagB->id],
        ]);

        $book = app(UpdateBookAction::class)->execute($book, $bookData);

        $this->assertEquals($bookData->name, $book->name);
        $this->assertEquals($bookData->original_name, $book->original_name);
        $this->assertEquals($bookData->description, $book->description);
        $this->assertEquals($bookData->release_year, $book->release_year);
        $this->assertEquals($bookData->author_id, $book->author_id);
        $this->assertEquals($bookData->series_id, $book->series->id);
        $this->assertCount(1, $book->genres);
        $book->genres->assertContains($genre);
        $this->assertCount(2, $book->tags);
        $book->tags->assertContains($tagA, $tagB);
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
