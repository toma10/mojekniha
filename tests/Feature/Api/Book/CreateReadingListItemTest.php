<?php

namespace Tests\Feature\Api\Book;

use App\Domain\Book\Models\Book;
use App\Domain\Book\Models\ReadingListItem;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateReadingListItemTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_authenticated()
    {
        $this->postJson('api/reading-list-items')
            ->assertUnauthorized();
    }

    /** @test */
    public function it_creates_a_reading_list_item()
    {
        $book =factory(Book::class)->create();
        $user =factory(User::class)->create();

        $response = $this->actingAs($user)->postJson('api/reading-list-items', ['book_id' => $book->id]);

        $response->assertCreated();

        $response->assertJsonStructure([
            'data' => [
                'id',
                'book',
                'rating',
                'notes',
            ],
        ]);

        $this->assertTrue($user->readingListItems->contains(fn (ReadingListItem $item) => $item->book->is($book)));
    }

    /** @test */
    public function it_requires_a_book_id()
    {
        $user =factory(User::class)->create();

        $response = $this->actingAs($user)->postJson('api/reading-list-items', ['book_id' => null]);

        $response->assertJsonValidationErrors('book_id');
    }
}
