<?php

namespace Tests\Unit\Domain\Book\Actions;

use App\Domain\Book\Actions\UploadBookCoverImageAction;
use App\Domain\Book\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadBookCoverImageActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_uploads_a_cover_image()
    {
        Storage::fake();

        $book = factory(Book::class)->create();
        $file = File::image('cover-image.jpg', $width = 400);

        (new UploadBookCoverImageAction())->execute($book, $file);

        $this->assertNotNull($book->getFirstMedia('cover-image'));
    }
}
