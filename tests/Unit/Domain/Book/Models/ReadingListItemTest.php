<?php

namespace Tests\Unit\Domain\Book\Models;

use App\Domain\Book\Models\Book;
use App\Domain\Book\Models\ReadingListItem;
use App\Domain\User\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReadingListItemTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belonts_to_a_book()
    {
        $book = factory(Book::class)->create();
        $readingListItem = factory(ReadingListItem::class)->create(['book_id' => $book]);

        $this->assertInstanceOf(BelongsTo::class, $readingListItem->book());
        $this->assertTrue($readingListItem->book->is($book));
    }

    /** @test */
    public function it_belonts_to_a_user()
    {
        $user = factory(User::class)->create();
        $readingListItem = factory(ReadingListItem::class)->create(['user_id' => $user]);

        $this->assertInstanceOf(BelongsTo::class, $readingListItem->user());
        $this->assertTrue($readingListItem->user->is($user));
    }
}
