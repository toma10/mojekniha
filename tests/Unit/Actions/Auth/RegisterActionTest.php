<?php

namespace Tests\Unit\Actions\Auth;

use Tests\TestCase;
use App\Models\User;
use App\Actions\Auth\RegisterAction;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\DataTransferObjects\Auth\RegisterData;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_registers_a_user()
    {
        Event::fake();

        $registerData = new RegisterData([
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@examlple.com',
            'password' => 'secret_password',
        ]);

        $token = app(RegisterAction::class)->execute($registerData);

        $this->assertNotNull($token);
        $this->assertAuthenticated();

        $user = User::first();
        $this->assertEquals($registerData->name, $user->name);
        $this->assertEquals($registerData->username, $user->username);
        $this->assertEquals($registerData->email, $user->email);
        $this->assertTrue(Hash::check($registerData->password, $user->password));

        Event::assertDispatched(Registered::class, function ($event) use ($user) {
            return $event->user->id === $user->id;
        });
    }
}
