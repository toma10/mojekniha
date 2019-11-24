<?php

namespace Tests\Unit\Actions;

use Tests\TestCase;
use App\Models\Author;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use App\Actions\UploadAuthorPortraitImageAction;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
