<?php

namespace Tests\Unit\Domain\Book\Actions;

use App\Domain\Book\Actions\CreateReadingListItemAction;
use App\Domain\Book\DataTransferObjects\CreateReadingListItemData;
use App\Domain\Book\Models\Book;
use App\Domain\Book\Models\ReadingListItem;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateReadingListItemActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_reading_list_item()
    {
        $book = factory(Book::class)->create();
        $user = factory(User::class)->create();

        $readingListItemData = new CreateReadingListItemData(['book_id' => $book->id]);

        $readingListItem = (new CreateReadingListItemAction())->execute($user, $readingListItemData);

        $this->assertTrue($readingListItem->book->is($book));
        $this->assertTrue($readingListItem->user->is($user));
    }

    /** @test */
    public function it_returns_a_reading_list_item_if_reading_list_item_for_given_book_already_exists()
    {
        $book = factory(Book::class)->create();
        $user = factory(User::class)->create();
        $readingListItem = factory(ReadingListItem::class)->create([
            'book_id' => $book,
            'user_id' => $user,
        ]);

        $readingListItemData = new CreateReadingListItemData(['book_id' => $book->id]);

        $returnedReadingListItem = (new CreateReadingListItemAction())->execute($user, $readingListItemData);

        $this->assertTrue($returnedReadingListItem->is($readingListItem));
    }
}
