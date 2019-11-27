<?php

namespace Tests\Unit\Actions;

use Mockery;
use Tests\TestCase;
use App\Models\Author;
use App\Models\Nationality;
use Illuminate\Http\Testing\File;
use App\Actions\UpdateAuthorAction;
use App\DataTransferObjects\AuthorData;
use Illuminate\Support\Facades\Storage;
use App\Actions\UploadAuthorPortraitImageAction;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateAuthorActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_the_author()
    {
        $author = factory(Author::class)->create();
        $nationality = factory(Nationality::class)->create();
        $authorData = new AuthorData([
            'name' => 'Joseph Heller',
            'birth_date' => '1923-05-01',
            'death_date' => '1999-12-12',
            'biography' => 'Psal satirická díla, zejména novely a dramata.',
            'nationality_id' => $nationality->id,
        ]);

        $author = app(UpdateAuthorAction::class)->execute($author, $authorData);

        $this->assertEquals($authorData->name, $author->name);
        $this->assertEquals($authorData->birth_date, $author->birth_date);
        $this->assertEquals($authorData->death_date, $author->death_date);
        $this->assertEquals($authorData->biography, $author->biography);
    }

    /** @test */
    public function upload_author_portrait_image_action_is_called_if_portrait_image_is_included()
    {
        Storage::fake('public');

        $author = factory(Author::class)->create();
        $nationality = factory(Nationality::class)->create();
        $file = File::image('portrait-image.jpg');
        $authorData = new AuthorData([
            'name' => 'Joseph Heller',
            'birth_date' => '1923-05-01',
            'death_date' => '1999-12-12',
            'biography' => 'Psal satirická díla, zejména novely a dramata.',
            'nationality_id' => $nationality->id,
            'portrait_image' => $file,
        ]);


        $this->mock(UploadAuthorPortraitImageAction::class, function ($mock) use ($file) {
            $mock
                ->shouldReceive()
                ->execute(Mockery::type(Author::class), Mockery::on(function ($uploadedFile) use ($file) {
                    return $file === $uploadedFile;
                }))
                ->once();
        });

        app(UpdateAuthorAction::class)->execute($author, $authorData);
    }
}
