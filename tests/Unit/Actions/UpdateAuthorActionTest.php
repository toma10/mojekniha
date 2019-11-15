<?php

namespace Tests\Unit\Actions;

use Tests\TestCase;
use App\Models\Author;
use App\Models\Nationality;
use App\Actions\UpdateAuthorAction;
use App\DataTransferObjects\AuthorData;
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
}
