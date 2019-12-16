<?php

namespace Tests\Unit\Domain\Book\Models;

use App\Domain\Book\Models\Book;
use App\Domain\Book\Models\Genre;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GenreTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_may_have_multiple_books()
    {
        $genre = factory(Genre::class)->create();
        $bookA = factory(Book::class)->create();
        $bookB = factory(Book::class)->create();

        $genre->books()->saveMany([$bookA, $bookB]);

        $this->assertInstanceOf(BelongsToMany::class, $genre->books());
        $genre->books->assertContains($bookA, $bookB);
    }
}
