<?php

namespace Tests\Unit\Domain\Auth\Actions;

use App\Domain\Auth\Actions\CreateUserAction;
use App\Domain\Auth\DataTransferObjects\UserData;
use App\Domain\Auth\Events\UserCreated;
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

        $userData = new UserData([
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
        ]);

        $user = app(CreateUserAction::class)->execute($userData);

        $this->assertEquals($userData->name, $user->name);
        $this->assertEquals($userData->username, $user->username);
        $this->assertEquals($userData->email, $user->email);
        $this->assertTrue(Hash::check($password, $user->password));

        Event::assertDispatched(UserCreated::class, function ($event) use ($user, $password) {
            return $event->user->is($user)
                && $event->password === $password;
        });
    }
}
