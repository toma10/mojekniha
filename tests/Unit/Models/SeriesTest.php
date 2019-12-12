<?php

namespace Tests\Unit\Models;

use App\Models\Author;
use App\Models\Book;
use App\Models\Series;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_an_author()
    {
        $author = factory(Author::class)->create();
        $series = factory(Series::class)->create(['author_id' => $author]);

        $this->assertInstanceOf(BelongsTo::class, $series->author());
        $this->assertTrue($series->author->is($author));
    }

    /** @test */
    public function it_may_have_multiple_books()
    {
        $series = factory(Series::class)->create();
        $bookA = factory(Book::class)->create(['series_id' => $series]);
        $bookB = factory(Book::class)->create(['series_id' => $series]);

        $this->assertInstanceOf(HasMany::class, $series->books());
        $series->books->assertContains($bookA, $bookB);
    }
}
