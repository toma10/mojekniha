<?php

namespace Tests\Unit\Actions\Auth;

use Tests\TestCase;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Actions\Auth\ResetPasswordAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\DataTransferObjects\Auth\ResetPasswordData;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ResetPasswordActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_reset_password()
    {
        $me = factory(User::class)->create(['email' => 'johndoe@examlple.com']);
        factory(PasswordReset::class)->create([
            'email' => $me->email,
            'token' => $token = 'RESET_TOKEN',
        ]);
        $resetPasswordData = new ResetPasswordData([
            'email' => $me->email,
            'token' => $token,
            'password' => 'new-password'
        ]);

        (new ResetPasswordAction)->execute($resetPasswordData);

        $this->assertTrue(Hash::check('new-password', $me->fresh()->password));
        $this->assertCount(0, PasswordReset::whereEmail($me->email)->get());
    }

    /** @test */
    public function it_throws_exception_if_invalid_token_is_provided()
    {
        $me = factory(User::class)->create(['email' => 'johndoe@examlple.com']);
        factory(PasswordReset::class)->create([
            'email' => $me->email,
            'token' => 'RESET_TOKEN',
        ]);
        $resetPasswordData = new ResetPasswordData([
            'email' => $me->email,
            'token' => 'INVALID_RESET_TOKEN',
            'password' => 'new-password'
        ]);

        try {
            (new ResetPasswordAction)->execute($resetPasswordData);
        } catch (HttpException $e) {
            $this->assertEquals(Response::HTTP_FORBIDDEN, $e->getStatusCode());
            return;
        }

        $this->fail('HttpException should be thrown, but was not.');
    }

    /** @test */
    public function it_throws_exception_if_token_doesn_t_exist()
    {
        $me = factory(User::class)->create(['email' => 'johndoe@examlple.com']);
        $resetPasswordData = new ResetPasswordData([
            'email' => $me->email,
            'token' => 'RESET_TOKEN',
            'password' => 'new-password'
        ]);

        try {
            (new ResetPasswordAction)->execute($resetPasswordData);
        } catch (HttpException $e) {
            $this->assertEquals(Response::HTTP_FORBIDDEN, $e->getStatusCode());
            return;
        }

        $this->fail('HttpException should be thrown, but was not.');
    }
}
