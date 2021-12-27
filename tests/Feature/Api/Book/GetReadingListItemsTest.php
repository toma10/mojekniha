<?php

namespace Tests\Feature\Api\Book;

use App\Domain\Book\Models\ReadingListItem;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetReadingListItemsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_authenticated()
    {
        $this->getJson('api/reading-list-items')
            ->assertUnauthorized();
    }

    /** @test */
    public function it_returns_user_reading_list_items()
    {
        $user = factory(User::class)->create();
        factory(ReadingListItem::class)->create(['user_id' => $user]);
        factory(ReadingListItem::class)->create(['user_id' => $user]);
        factory(ReadingListItem::class)->create(['user_id' => $user]);

        $response = $this->actingAs($user)->getJson('api/reading-list-items');

        $response->assertOk();
        $response->assertJsonCount(3, 'data');
    }
}
