<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
