<?php

namespace Tests\Unit\Domain\Auth\Actions;

use App\Domain\Auth\Actions\VerifyEmailAction;
use App\Domain\Auth\DataTransferObjects\VerifyEmailData;
use App\Domain\Auth\Events\EmailVerified;
use App\Domain\Auth\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class VerifyEmailActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_verifies_the_user()
    {
        Event::fake();

        $me = factory(User::class)->create();
        $this->assertFalse($me->hasVerifiedEmail());

        $verifyEmailData = new VerifyEmailData([
            'id' => $me->id,
            'hash' => sha1($me->email),
        ]);

        (new VerifyEmailAction())->execute($me, $verifyEmailData);

        $this->assertTrue($me->fresh()->hasVerifiedEmail());

        Event::assertDispatched(EmailVerified::class, function ($event) use ($me) {
            return $event->user->is($me);
        });
    }

    /** @test */
    public function it_does_nothing_if_user_is_already_verified()
    {
        Event::fake();

        $me = factory(User::class)->states('verified')->create();
        $this->assertTrue($me->hasVerifiedEmail());

        $verifyEmailData = new VerifyEmailData([
            'id' => $me->id,
            'hash' => sha1($me->email),
        ]);

        (new VerifyEmailAction())->execute($me, $verifyEmailData);

        $this->assertTrue($me->fresh()->hasVerifiedEmail());

        Event::assertNotDispatched(EmailVerified::class);
    }

    /** @test */
    public function it_throws_authorization_exception_if_id_is_invalid()
    {
        $me = factory(User::class)->create();
        $this->assertFalse($me->hasVerifiedEmail());

        $verifyEmailData = new VerifyEmailData([
            'id' => 999,
            'hash' => sha1($me->email),
        ]);

        try {
            (new VerifyEmailAction())->execute($me, $verifyEmailData);
        } catch (AuthorizationException $e) {
            $this->assertFalse($me->fresh()->hasVerifiedEmail());

            return;
        }

        $this->fail('AuthorizationException should be thrown, but was not.');
    }

    /** @test */
    public function it_throws_authorization_exception_if_hash_is_invalid()
    {
        $me = factory(User::class)->create();
        $this->assertFalse($me->hasVerifiedEmail());

        $verifyEmailData = new VerifyEmailData([
            'id' => $me->id,
            'hash' => 'not-a-valid-hash',
        ]);

        try {
            (new VerifyEmailAction())->execute($me, $verifyEmailData);
        } catch (AuthorizationException $e) {
            $this->assertFalse($me->fresh()->hasVerifiedEmail());

            return;
        }

        $this->fail('AuthorizationException should be thrown, but was not.');
    }
}
