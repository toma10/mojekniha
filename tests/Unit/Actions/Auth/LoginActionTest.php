<?php

namespace Tests\Unit\Actions\Auth;

use App\Actions\LoginAction;
use App\DataTransferObjects\Auth\LoginData;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class LoginActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_logs_in_a_user()
    {
        $user = factory(User::class)->create([
            'email' => 'johndoe@examlple.com',
            'password' => Hash::make('password'),
        ]);

        $loginData = new LoginData([
            'email' => 'johndoe@examlple.com',
            'password' => 'password',
        ]);

        (new LoginAction())->execute($loginData);

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function it_throws_validation_exception_if_invalid_credentials_provided()
    {
        $user = factory(User::class)->create([
            'email' => 'johndoe@examlple.com',
            'password' => Hash::make('password'),
        ]);

        $loginData = new LoginData([
            'email' => 'johndoe@examlple.com',
            'password' => 'not-a-valid-password',
        ]);

        try {
            (new LoginAction())->execute($loginData);
        } catch (ValidationException $e) {
            $this->assertArrayHasKey('email', $e->errors());

            return;
        }

        $this->fail('ValidationException should be thrown, but was not.');
    }
}
