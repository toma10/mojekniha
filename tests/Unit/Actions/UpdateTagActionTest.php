<?php

namespace Tests\Unit\Actions;

use App\Models\Tag;
use Tests\TestCase;
use App\Actions\UpdateTagAction;
use App\DataTransferObjects\TagData;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTagActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_the_tag()
    {
        $tag = factory(Tag::class)->create();
        $tagData = new TagData([
            'name' => 'Romány',
        ]);

        $tag = (new UpdateTagAction())->execute($tag, $tagData);

        $this->assertEquals($tagData->name, $tag->name);
    }
}
