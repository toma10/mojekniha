<?php

namespace Tests\Unit\Domain\User\Models;

use App\Domain\Book\Models\Book;
use App\Domain\Book\Models\ReadingListItem;
use App\Domain\User\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_may_have_multiple_reading_list_items()
    {
        $user = factory(User::class)->create();
        $readingListItemA = factory(ReadingListItem::class)->create(['user_id' => $user]);
        $readingListItemB = factory(ReadingListItem::class)->create(['user_id' => $user]);

        $this->assertInstanceOf(HasMany::class, $user->readingListItems());
        $user->readingListItems->assertContains($readingListItemA, $readingListItemB);
    }

    /** @test */
    public function it_can_determine_if_it_owns_the_reading_list_item()
    {
        $user = factory(User::class)->create();
        $otherUser = factory(User::class)->create();
        $readingListItemA = factory(ReadingListItem::class)->create(['user_id' => $user]);
        $readingListItemB = factory(ReadingListItem::class)->create(['user_id' => $otherUser]);

        $this->assertTrue($user->ownsReadingListItem($readingListItemA));
        $this->assertFalse($user->ownsReadingListItem($readingListItemB));
    }

    /** @test */
    public function it_can_get_reading_list_item_for_given_book()
    {
        $user = factory(User::class)->create();
        $otherUser = factory(User::class)->create();
        $bookA = factory(Book::class)->create();
        $bookB = factory(Book::class)->create();
        $readingListItem = factory(ReadingListItem::class)->create([
            'user_id' => $user,
            'book_id' => $bookA,
        ]);
        factory(ReadingListItem::class)->create([
            'user_id' => $otherUser,
            'book_id' => $bookB,
        ]);

        $this->assertNotNull($user->getReadingListItemForBook($bookA));
        $this->assertTrue($user->getReadingListItemForBook($bookA)->is($readingListItem));
        $this->assertNull($user->getReadingListItemForBook($bookB));
    }

    /** @test */
    public function it_can_find_user_by_email()
    {
        $user = factory(User::class)->create(['email' => 'johndoe@example.com']);

        $foundUser = User::findByEmail('johndoe@example.com');

        $this->assertTrue($foundUser->is($user));
    }

    /** @test */
    public function it_returns_avatar_url()
    {
        $user = factory(User::class)->make(['email' => 'johndoe@example.com']);
        $emailMd5 = md5('johndoe@example.com');

        $this->assertEquals("https://www.gravatar.com/avatar/${emailMd5}?d=mp&s=150", $user->avatarUrl(150));
        $this->assertEquals("https://www.gravatar.com/avatar/${emailMd5}?d=mp&s=300", $user->avatarUrl(300));
        $this->assertEquals("https://www.gravatar.com/avatar/${emailMd5}?d=mp&s=150", $user->avatarUrl);
    }

    /** @test */
    public function it_can_determine_if_is_admin()
    {
        $user = factory(User::class)->create(['is_admin' => false]);
        $admin = factory(User::class)->create(['is_admin' => true]);

        $this->assertFalse($user->isAdmin());
        $this->assertTrue($admin->isAdmin());
    }

    /** @test */
    public function it_can_determine_if_has_verified_email()
    {
        $unverifiedUser = factory(User::class)->create(['email_verified_at' => null]);
        $verifiedUser = factory(User::class)->create(['email_verified_at' => now()]);

        $this->assertFalse($unverifiedUser->hasVerifiedEmail());
        $this->assertFalse($unverifiedUser->is_verified);
        $this->assertTrue($verifiedUser->hasVerifiedEmail());
        $this->assertTrue($verifiedUser->is_verified);
    }
}
