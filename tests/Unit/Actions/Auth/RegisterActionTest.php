<?php

namespace Tests\Unit\Actions\Auth;

use Tests\TestCase;
use App\Models\User;
use App\Events\Auth\Registered;
use App\Actions\Auth\RegisterAction;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
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
            'verify_email_url' => 'http://url.dev',
        ]);

        $token = app(RegisterAction::class)->execute($registerData);

        $this->assertNotNull($token);
        $this->assertAuthenticated();

        $this->assertAuthenticatedAs($user = User::first());
        $this->assertEquals($registerData->name, $user->name);
        $this->assertEquals($registerData->username, $user->username);
        $this->assertEquals($registerData->email, $user->email);
        $this->assertTrue(Hash::check($registerData->password, $user->password));

        Event::assertDispatched(Registered::class, function ($event) use ($user) {
            return $event->user->is($user);
        });
    }
}
