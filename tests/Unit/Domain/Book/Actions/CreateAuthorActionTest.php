<?php

namespace Tests\Unit\Domain\Book\Actions;

use App\Domain\Book\Actions\CreateAuthorAction;
use App\Domain\Book\Actions\UploadAuthorPortraitImageAction;
use App\Domain\Book\DataTransferObjects\AuthorData;
use App\Domain\Book\Models\Author;
use App\Domain\Book\Models\Nationality;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Mockery;
use Tests\TestCase;

class CreateAuthorActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_an_author()
    {
        $nationality = factory(Nationality::class)->create(['name' => 'americká']);
        $authorData = new AuthorData([
            'name' => 'Joseph Heller',
            'birth_date' => '1923-05-01',
            'death_date' => '1999-12-12',
            'biography' => 'Psal satirická díla, zejména novely a dramata.',
            'nationality_id' => $nationality->id,
        ]);

        $author = app(CreateAuthorAction::class)->execute($authorData);

        $this->assertEquals($authorData->name, $author->name);
        $this->assertEquals($authorData->birth_date, $author->birth_date);
        $this->assertEquals($authorData->death_date, $author->death_date);
        $this->assertEquals($authorData->biography, $author->biography);
        $this->assertEquals($authorData->nationality_id, $author->nationality_id);
    }

    /** @test */
    public function upload_author_portrait_image_action_is_called_if_portrait_image_is_included()
    {
        Storage::fake('public');

        $nationality = factory(Nationality::class)->create(['name' => 'americká']);
        $file = File::image('portrait-image.jpg', $width = 400);
        $authorData = new AuthorData([
            'name' => 'Joseph Heller',
            'birth_date' => '1923-05-01',
            'death_date' => '1999-12-12',
            'biography' => 'Psal satirická díla, zejména novely a dramata.',
            'nationality_id' => $nationality->id,
            'portrait_image' => $file,
        ]);

        $uploadAuthorPortraitImageAction = $this->mock(UploadAuthorPortraitImageAction::class);
        $uploadAuthorPortraitImageAction
            ->shouldReceive()
            ->execute(Mockery::type(Author::class), Mockery::on(function ($uploadedFile) use ($file) {
                return $file === $uploadedFile;
            }))
            ->once();

        app(CreateAuthorAction::class)->execute($authorData);
    }
}
