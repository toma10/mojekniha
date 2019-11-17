<?php

namespace Tests\Unit\Models;

use App\Models\Tag;
use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TagTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_may_have_multiple_books()
    {
        $tag = factory(Tag::class)->create();
        $bookA = factory(Book::class)->create();
        $bookB = factory(Book::class)->create();

        $tag->books()->saveMany([$bookA, $bookB]);

        $this->assertInstanceOf(BelongsToMany::class, $tag->books());
        $tag->books->assertContains($bookA, $bookB);
    }
}
