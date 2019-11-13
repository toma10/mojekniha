<?php

namespace Tests\Unit\Actions;

use Tests\TestCase;
use App\Models\Author;
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
        $authorData = new AuthorData([
            'name' => 'Ernest Hemingway',
            'birth_date' => '1899-07-12',
            'death_date' => '1961-07-02',
            'biography' => 'Je považován za čelního představitele tzv. ztracené generace.',
        ]);

        $author = (new UpdateAuthorAction())->execute($author, $authorData);

        $this->assertEquals($authorData->name, $author->name);
        $this->assertEquals($authorData->birth_date, $author->birth_date);
        $this->assertEquals($authorData->death_date, $author->death_date);
        $this->assertEquals($authorData->biography, $author->biography);
    }
}
