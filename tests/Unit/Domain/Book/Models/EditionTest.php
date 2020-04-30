<?php

namespace Tests\Unit\Domain\Book\Models;

use App\Domain\Book\Actions\UploadEditionCoverImageAction;
use App\Domain\Book\Models\Book;
use App\Domain\Book\Models\BookBinding;
use App\Domain\Book\Models\Edition;
use App\Domain\Book\Models\Language;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EditionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_cover_url()
    {
        Storage::fake('public');

        $edition = factory(Edition::class)->create();
        $file = File::image('cover-image.jpg', $width = 400);

        $this->assertEquals(url(Edition::FALLBACK_COVER_IMAGE), $edition->cover_url);

        (new UploadEditionCoverImageAction())->execute($edition, $file);
        $this->assertEquals($edition->getFirstMediaUrl('cover-image'), $edition->cover_url);
    }

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
