<?php

namespace Tests\Unit\Actions;

use Tests\TestCase;
use App\Models\Author;
use App\Actions\CreateAuthorAction;
use App\DataTransferObjects\AuthorData;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateAuthorActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_an_author()
    {
        $authorData = new AuthorData(factory(Author::class)->raw());

        $author = (new CreateAuthorAction())->execute($authorData);

        $this->assertEquals($authorData->name, $author->name);
        $this->assertEquals($authorData->birth_date, $author->birth_date);
        $this->assertEquals($authorData->death_date, $author->death_date);
        $this->assertEquals($authorData->biography, $author->biography);
    }
}
