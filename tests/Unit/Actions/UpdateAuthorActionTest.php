<?php

namespace Tests\Unit\Actions;

use Tests\TestCase;
use App\Models\Author;
use App\Models\Nationality;
use Illuminate\Http\Testing\File;
use App\Actions\UpdateAuthorAction;
use App\DataTransferObjects\AuthorData;
use Illuminate\Support\Facades\Storage;
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

        $author = (new UpdateAuthorAction())->execute($author, $authorData);

        $this->assertEquals($authorData->name, $author->name);
        $this->assertEquals($authorData->birth_date, $author->birth_date);
        $this->assertEquals($authorData->death_date, $author->death_date);
        $this->assertEquals($authorData->biography, $author->biography);
    }

    /** @test */
    public function portrait_image_is_uploaded_if_included()
    {
        Storage::fake('public');

        $author = factory(Author::class)->create();
        $nationality = factory(Nationality::class)->create();
        $file = File::image('portrait-image.png');
        $authorData = new AuthorData([
            'name' => 'Joseph Heller',
            'birth_date' => '1923-05-01',
            'death_date' => '1999-12-12',
            'biography' => 'Psal satirická díla, zejména novely a dramata.',
            'nationality_id' => $nationality->id,
            'portrait_image' => $file,
        ]);

        $author = (new UpdateAuthorAction())->execute($author, $authorData);

        Storage::disk('public')->assertExists($author->portrait_image_path);
        $this->assertFileEquals(
            $file->getPathname(),
            Storage::disk('public')->path($author->portrait_image_path)
        );
    }

    /** @test */
    public function it_removes_old_image_if_new_is_included()
    {
        Storage::fake('public');

        $currentPortraitImagePath = File::image('current-portrait-image.png')->store('book-portraits', ['disk' => 'public']);
        $author = factory(Author::class)->create(['portrait_image_path' => $currentPortraitImagePath]);
        $nationality = factory(Nationality::class)->create();
        $file = File::image('portrait-image.png');
        $authorData = new AuthorData([
            'name' => 'Joseph Heller',
            'birth_date' => '1923-05-01',
            'death_date' => '1999-12-12',
            'biography' => 'Psal satirická díla, zejména novely a dramata.',
            'nationality_id' => $nationality->id,
            'portrait_image' => $file,
        ]);

        $author = (new UpdateAuthorAction())->execute($author, $authorData);

        Storage::disk('public')->assertExists($author->portrait_image_path);
        $this->assertFileEquals(
            $file->getPathname(),
            Storage::disk('public')->path($author->portrait_image_path)
        );
        Storage::disk('public')->assertMissing($currentPortraitImagePath);
    }
}
