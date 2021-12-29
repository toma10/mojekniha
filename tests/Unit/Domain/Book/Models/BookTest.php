<?php

namespace Tests\Unit\Domain\Book\Models;

use App\Domain\Book\Actions\UploadBookCoverImageAction;
use App\Domain\Book\Models\Author;
use App\Domain\Book\Models\Book;
use App\Domain\Book\Models\Edition;
use App\Domain\Book\Models\Genre;
use App\Domain\Book\Models\ReadingListItem;
use App\Domain\Book\Models\Series;
use App\Domain\Book\Models\Tag;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_cover_url()
    {
        Storage::fake('public');

        $book = factory(Book::class)->create();
        $file = File::image('cover-image.jpg', $width = 400);

        $this->assertEquals(url(Book::FALLBACK_COVER_IMAGE), $book->cover_url);

        (new UploadBookCoverImageAction())->execute($book, $file);
        $this->assertEquals($book->getFirstMediaUrl('cover-image'), $book->cover_url);
    }

    /** @test */
    public function it_belongs_to_an_author()
    {
        $author = factory(Author::class)->create();
        $book = factory(Book::class)->create(['author_id' => $author]);

        $this->assertInstanceOf(BelongsTo::class, $book->author());
        $this->assertTrue($book->author->is($author));
    }

    /** @test */
    public function it_may_have_multiple_editions()
    {
        $book = factory(Book::class)->create();
        $editionA = factory(Edition::class)->create(['book_id' => $book->id]);
        $editionB = factory(Edition::class)->create(['book_id' => $book->id]);

        $this->assertInstanceOf(HasMany::class, $book->editions());
        $book->editions->assertContains($editionA, $editionB);
    }

    /** @test */
    public function it_may_belongs_to_multiple_genres()
    {
        $book = factory(Book::class)->create();
        $genreA = factory(Genre::class)->create();
        $genreB = factory(Genre::class)->create();

        $book->genres()->saveMany([$genreA, $genreB]);

        $this->assertInstanceOf(BelongsToMany::class, $book->genres());
        $book->genres->assertContains($genreA, $genreB);
    }

    /** @test */
    public function it_may_belongs_to_multiple_tags()
    {
        $book = factory(Book::class)->create();
        $tagA = factory(Tag::class)->create();
        $tagB = factory(Tag::class)->create();

        $book->tags()->saveMany([$tagA, $tagB]);

        $this->assertInstanceOf(BelongsToMany::class, $book->tags());
        $book->tags->assertContains($tagA, $tagB);
    }

    /** @test */
    public function it_may_belongs_to_a_series()
    {
        $series = factory(Series::class)->create();
        $bookA = factory(Book::class)->create(['series_id' => $series]);
        $bookB = factory(Book::class)->create(['series_id' => null]);

        $this->assertInstanceOf(BelongsTo::class, $bookA->series());
        $this->assertTrue($bookA->series->is($series));
        $this->assertNull($bookB->series);
    }

    /** @test */
    public function it_may_have_multiple_reading_list_items()
    {
        $book = factory(Book::class)->create();
        $readingListItemA = factory(ReadingListItem::class)->create(['book_id' => $book]);
        $readingListItemB = factory(ReadingListItem::class)->create(['book_id' => $book]);

        $this->assertInstanceOf(HasMany::class, $book->readingListItems());
        $book->readingListItems->assertContains($readingListItemA, $readingListItemB);
    }

    /** @test */
    public function it_returns_average_rating()
    {
        $book = factory(Book::class)->create();

        factory(ReadingListItem::class)->create([
            'book_id' => $book,
            'rating' => 2,
        ]);
        factory(ReadingListItem::class)->create([
            'book_id' => $book,
            'rating' => 4,
        ]);
        factory(ReadingListItem::class)->create([
            'book_id' => $book,
            'rating' => 2,
        ]);
        factory(ReadingListItem::class)->create([
            'book_id' => $book,
            'rating' => 3,
        ]);

        $this->assertEquals(2.75, Book::findOrFail($book->id)->average_rating);
    }
}
