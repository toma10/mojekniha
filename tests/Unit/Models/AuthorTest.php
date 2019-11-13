<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_may_have_multiple_books()
    {
        $author = factory(Author::class)->create();
        $bookA = factory(Book::class)->create(['author_id' => $author]);
        $bookB = factory(Book::class)->create(['author_id' => $author]);

        $this->assertInstanceOf(HasMany::class, $author->books());
        $author->books->assertContains($bookA, $bookB);
    }
}
