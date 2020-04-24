<?php

namespace Tests\Unit\Domain\Auth\Actions;

use App\Domain\Auth\Actions\LoginWebAction;
use App\Domain\Auth\DataTransferObjects\LoginData;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

class LoginWebActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_logs_in_an_admin()
    {
        $user = factory(User::class)->state('admin')->create([
            'email' => 'johndoe@examlple.com',
            'password' => Hash::make('password'),
        ]);

        $loginData = new LoginData([
            'email' => 'johndoe@examlple.com',
            'password' => 'password',
            'remember' => true,
        ]);

        (new LoginWebAction())->execute($loginData);

        $this->assertAuthenticatedAs($user, 'web');
    }

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create([
            'email' => 'johndoe@examlple.com',
            'password' => Hash::make('password'),
        ]);

        $loginData = new LoginData([
            'email' => 'johndoe@examlple.com',
            'password' => 'password',
            'remember' => true,
        ]);

        try {
            (new LoginWebAction())->execute($loginData);
        } catch (HttpException $e) {
            $this->assertEquals(403, $e->getStatusCode());

            return;
        }

        $this->fail('HttpException should be thrown, but was not.');
    }

    /** @test */
    public function it_throws_validation_exception_if_invalid_credentials_provided()
    {
        $user = factory(User::class)->state('admin')->create([
            'email' => 'johndoe@examlple.com',
            'password' => Hash::make('password'),
        ]);

        $loginData = new LoginData([
            'email' => 'johndoe@examlple.com',
            'password' => 'not-a-valid-password',
            'remember' => true,
        ]);

        try {
            (new LoginWebAction())->execute($loginData);
        } catch (ValidationException $e) {
            $this->assertArrayHasKey('email', $e->errors());

            return;
        }

        $this->fail('ValidationException should be thrown, but was not.');
    }
}
