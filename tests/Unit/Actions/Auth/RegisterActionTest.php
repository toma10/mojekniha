<?php

namespace Tests\Unit\Actions\Auth;

use App\Actions\Auth\RegisterAction;
use App\DataTransferObjects\Auth\RegisterData;
use App\Events\Auth\Registered;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

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
