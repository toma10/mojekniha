<?php

namespace Tests\Unit\Actions;

use Tests\TestCase;
use App\Actions\CreateTagAction;
use App\DataTransferObjects\TagData;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
