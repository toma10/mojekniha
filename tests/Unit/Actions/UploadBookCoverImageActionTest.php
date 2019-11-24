<?php

namespace Tests\Unit\Actions;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use App\Actions\UploadBookCoverImageAction;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
