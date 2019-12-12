<?php

namespace Tests\Unit\Actions;

use App\Actions\UploadEditionCoverImageAction;
use App\Models\Edition;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadEditionCoverImageActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_uploads_a_cover_image()
    {
        Storage::fake();

        $edition = factory(Edition::class)->create();
        $file = File::image('cover-image.jpg', $width = 400);

        (new UploadEditionCoverImageAction())->execute($edition, $file);

        $this->assertNotNull($edition->getFirstMedia('cover-image'));
    }
}
