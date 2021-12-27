<?php

namespace App\Domain\Book\Actions;

use App\Domain\Book\DataTransferObjects\UpdateReadingListItemData;
use App\Domain\Book\Models\ReadingListItem;

class UpdateReadingListItemAction
{
    public function execute(ReadingListItem $readingListItem, UpdateReadingListItemData $data): ReadingListItem
    {
        $readingListItem->update($data->all());

        return $readingListItem;
    }
}
