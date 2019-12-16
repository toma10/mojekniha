<?php

namespace Tests\Unit\Domain\Book\Actions;

use App\Domain\Book\Actions\CreateTagAction;
use App\Domain\Book\DataTransferObjects\TagData;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTagActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_tag()
    {
        $tagData = new TagData([
            'name' => 'zfilmovano',
        ]);

        $tag = (new CreateTagAction())->execute($tagData);

        $this->assertEquals($tagData->name, $tag->name);
    }
}
