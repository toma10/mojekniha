<?php

namespace Tests\Unit\Models;

use App\Models\Tag;
use Tests\TestCase;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_book()
    {
        $author = factory(Author::class)->create();
        $book = factory(Book::class)->create(['author_id' => $author]);

        $this->assertInstanceOf(BelongsTo::class, $book->author());
        $this->assertTrue($book->author->is($author));
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
}
