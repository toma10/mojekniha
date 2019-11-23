<?php

namespace Tests\Unit\Actions;

use Tests\TestCase;
use App\Models\Nationality;
use Illuminate\Http\Testing\File;
use App\Actions\CreateAuthorAction;
use App\DataTransferObjects\AuthorData;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

        $author = (new CreateAuthorAction())->execute($authorData);

        $this->assertEquals($authorData->name, $author->name);
        $this->assertEquals($authorData->birth_date, $author->birth_date);
        $this->assertEquals($authorData->death_date, $author->death_date);
        $this->assertEquals($authorData->biography, $author->biography);
        $this->assertEquals($authorData->nationality_id, $author->nationality_id);
    }

    /** @test */
    public function portrait_image_is_uploaded_if_included()
    {
        Storage::fake('public');

        $nationality = factory(Nationality::class)->create(['name' => 'americká']);
        $file = File::image('portrait-image.png', $width = 400);
        $authorData = new AuthorData([
            'name' => 'Joseph Heller',
            'birth_date' => '1923-05-01',
            'death_date' => '1999-12-12',
            'biography' => 'Psal satirická díla, zejména novely a dramata.',
            'nationality_id' => $nationality->id,
            'portrait_image' => $file,
        ]);

        $author = (new CreateAuthorAction())->execute($authorData);

        Storage::disk('public')->assertExists($author->portrait_image_path);
        $this->assertFileEquals(
            $file->getPathname(),
            Storage::disk('public')->path($author->portrait_image_path)
        );
    }
}
