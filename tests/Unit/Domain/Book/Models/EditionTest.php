<?php

namespace Tests\Unit\Domain\Book\Models;

use App\Domain\Book\Models\Book;
use App\Domain\Book\Models\BookBinding;
use App\Domain\Book\Models\Edition;
use App\Domain\Book\Models\Language;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belonts_to_a_book()
    {
        $book = factory(Book::class)->create();
        $edition = factory(Edition::class)->create(['book_id' => $book]);

        $this->assertInstanceOf(BelongsTo::class, $edition->book());
        $this->assertTrue($edition->book->is($book));
    }

    /** @test */
    public function it_has_a_language()
    {
        $language = factory(Language::class)->create();
        $edition = factory(Edition::class)->create(['language_id' => $language]);

        $this->assertInstanceOf(BelongsTo::class, $edition->language());
        $this->assertTrue($edition->language->is($language));
    }

    /** @test */
    public function it_has_a_book_binding()
    {
        $bookBinding = factory(BookBinding::class)->create();
        $edition = factory(Edition::class)->create(['book_binding_id' => $bookBinding]);

        $this->assertInstanceOf(BelongsTo::class, $edition->bookBinding());
        $this->assertTrue($edition->bookBinding->is($bookBinding));
    }
}
