<?php

namespace Tests\Feature\Api\Book;

use App\Domain\Book\Models\ReadingListItem;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteReadingListItemTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_authenticated()
    {
        $readingListItem = factory(ReadingListItem::class)->create();

        $this->deleteJson("api/reading-list-items/{$readingListItem->id}")
            ->assertUnauthorized();
    }

    /** @test */
    public function it_403s_if_user_doesnt_own_a_reading_list_item()
    {
        $user = factory(User::class)->create();
        $readingListItem = factory(ReadingListItem::class)->create();

        $response = $this->actingAs($user)->deleteJson("api/reading-list-items/{$readingListItem->id}");

        $response->assertForbidden();
    }

    /** @test */
    public function it_deletes_the_reading_list_item()
    {
        $readingListItem = factory(ReadingListItem::class)->create();

        $response = $this->actingAs($readingListItem->user)->deleteJson("api/reading-list-items/{$readingListItem->id}");

        $response->assertOk();
    }
}
