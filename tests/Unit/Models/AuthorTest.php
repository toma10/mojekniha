<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Author;
use App\Models\Series;
use App\Models\Nationality;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_nationality()
    {
        $nationality = factory(Nationality::class)->create();
        $author = factory(Author::class)->create(['nationality_id' => $nationality]);

        $this->assertInstanceOf(BelongsTo::class, $author->nationality());
        $this->assertTrue($author->nationality->is($nationality));
    }

    /** @test */
    public function it_may_have_multiple_books()
    {
        $author = factory(Author::class)->create();
        $bookA = factory(Book::class)->create(['author_id' => $author]);
        $bookB = factory(Book::class)->create(['author_id' => $author]);

        $this->assertInstanceOf(HasMany::class, $author->books());
        $author->books->assertContains($bookA, $bookB);
    }

    /** @test */
    public function it_may_have_multiple_series()
    {
        $author = factory(Author::class)->create();
        $seriesA = factory(Series::class)->create(['author_id' => $author]);
        $seriesB = factory(Series::class)->create(['author_id' => $author]);

        $this->assertInstanceOf(HasMany::class, $author->series());
        $author->series->assertContains($seriesA, $seriesB);
    }
}
