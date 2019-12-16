<?php

namespace Tests\Unit\Domain\Book\Actions;

use App\Domain\Book\Actions\UploadAuthorPortraitImageAction;
use App\Domain\Book\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadAuthorPortraitImageActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_uploads_a_portrait_image()
    {
        Storage::fake();

        $author = factory(Author::class)->create();
        $file = File::image('portrait-image.jpg', $width = 400);

        (new UploadAuthorPortraitImageAction())->execute($author, $file);

        $this->assertNotNull($author->getFirstMedia('portrait-image'));
    }
}
