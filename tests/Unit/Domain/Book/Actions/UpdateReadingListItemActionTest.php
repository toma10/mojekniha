<?php

namespace Tests\Unit\Domain\Book\Actions;

use App\Domain\Book\Actions\UpdateReadingListItemAction;
use App\Domain\Book\DataTransferObjects\UpdateReadingListItemData;
use App\Domain\Book\Models\ReadingListItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateReadingListItemActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_the_reading_list_item()
    {
        $readingListItem = factory(ReadingListItem::class)->create();

        $readingListItem = app(UpdateReadingListItemAction::class)->execute(
            $readingListItem,
            new UpdateReadingListItemData(['notes' => 'Prety good'])
        );

        $this->assertEquals('Prety good', $readingListItem->notes);
    }
}
