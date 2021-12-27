<?php

namespace App\Domain\Book\Actions;

use App\Domain\Book\DataTransferObjects\CreateReadingListItemData;
use App\Domain\Book\Models\Book;
use App\Domain\Book\Models\ReadingListItem;
use App\Domain\User\Models\User;

class CreateReadingListItemAction
{
    public function execute(User $user, CreateReadingListItemData $data): ReadingListItem
    {
        $book = Book::findOrFail($data->book_id);

        $readingListItem = $user->getReadingListItemForBook($book);

        if (! $readingListItem) {
            return $user->readingListItems()->create(['book_id' => $book->id]);
        }

        return $readingListItem;
    }
}
