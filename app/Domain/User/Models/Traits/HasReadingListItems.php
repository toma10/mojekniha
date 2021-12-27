<?php

namespace App\Domain\User\Models\Traits;

use App\Domain\Book\Models\Book;
use App\Domain\Book\Models\ReadingListItem;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasReadingListItems
{
    public function getReadingListItemForBook(Book $book): ?ReadingListItem
    {
        return $this->readingListItems()->where('book_id', $book->id)->first();
    }

    public function ownsReadingListItem(ReadingListItem $readingListItem): bool
    {
        return $readingListItem->user->is($this);
    }

    public function readingListItems(): HasMany
    {
        return $this->hasMany(ReadingListItem::class);
    }
}
