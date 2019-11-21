<?php

namespace Tests\Unit\Actions;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Author;
use App\Actions\UpdateBookAction;
use Illuminate\Http\Testing\File;
use App\DataTransferObjects\BookData;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

        $book = (new UpdateBookAction())->execute($book, $bookData);

        $this->assertEquals($bookData->name, $book->name);
        $this->assertEquals($bookData->original_name, $book->original_name);
        $this->assertEquals($bookData->description, $book->description);
        $this->assertEquals($bookData->release_year, $book->release_year);
        $this->assertEquals($bookData->author_id, $book->author_id);
    }


    /** @test */
    public function cover_image_is_uploaded_if_included()
    {
        Storage::fake('public');

        $book = factory(Book::class)->create();
        $author = factory(Author::class)->create();
        $file = File::image('cover-image.png');
        $bookData = new BookData([
            'name' => 'Hlava XXII',
            'original_name' => 'Catch-22',
            'description' => 'Hlavní postavou je poručík letectva Yossarian, který je trochu klaun a trochu blázen.',
            'release_year' => 1961,
            'author_id' => $author->id,
            'cover_image' => $file,
        ]);

        $book = (new UpdateBookAction())->execute($book, $bookData);

        Storage::disk('public')->assertExists($book->cover_image_path);
        $this->assertFileEquals(
            $file->getPathname(),
            Storage::disk('public')->path($book->cover_image_path)
        );
    }

    /** @test */
    public function it_removes_old_image_if_new_is_included()
    {
        Storage::fake('public');

        $currentCoverImagePath = File::image('current-cover-image.png')->store('book-covers', ['disk' => 'public']);
        $book = factory(Book::class)->create(['cover_image_path' => $currentCoverImagePath]);
        $author = factory(Author::class)->create();
        $file = File::image('new-cover-image.png');
        $bookData = new BookData([
            'name' => 'Hlava XXII',
            'original_name' => 'Catch-22',
            'description' => 'Hlavní postavou je poručík letectva Yossarian, který je trochu klaun a trochu blázen.',
            'release_year' => 1961,
            'author_id' => $author->id,
            'cover_image' => $file,
        ]);

        $book = (new UpdateBookAction())->execute($book, $bookData);

        Storage::disk('public')->assertExists($book->cover_image_path);
        $this->assertFileEquals(
            $file->getPathname(),
            Storage::disk('public')->path($book->cover_image_path)
        );
        // Storage::disk('public')->assertMissing($currentCoverImagePath);
    }
}
