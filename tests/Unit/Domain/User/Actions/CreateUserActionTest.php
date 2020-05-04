<?php

namespace Tests\Unit\Domain\User\Actions;

use App\Domain\User\Actions\CreateUserAction;
use App\Domain\User\DataTransferObjects\CreateUserData;
use App\Domain\User\Events\UserCreated;
use Facades\App\Domain\Auth\Support\PasswordGenerator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CreateUserActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_the_user()
    {
        Event::fake();

        PasswordGenerator::shouldReceive('generate')
            ->once()
            ->andReturn($password = 'PASSWORD');

        $userData = new CreateUserData([
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
        ]);

        $user = app(CreateUserAction::class)->execute($userData);

        $this->assertEquals($userData->name, $user->name);
        $this->assertEquals($userData->username, $user->username);
        $this->assertEquals($userData->email, $user->email);
        $this->assertNotNull($user->email_verified_at);
        $this->assertTrue(Hash::check($password, $user->password));

        Event::assertDispatched(UserCreated::class, function ($event) use ($user, $password) {
            return $event->user->is($user)
                && $event->password === $password;
        });
    }
}
