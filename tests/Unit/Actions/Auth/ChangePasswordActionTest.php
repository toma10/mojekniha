<?php

namespace Tests\Unit\Actions\Auth;

use App\Actions\Auth\ChangePasswordAction;
use App\DataTransferObjects\PasswordData;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class ChangePasswordActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_change_password()
    {
        $me = factory(User::class)->create(['password' => Hash::make('password')]);
        $passwordData = new PasswordData([
            'password' => 'password',
            'new_password' => 'new-password',
        ]);

        $me = (new ChangePasswordAction())->execute($me, $passwordData);

        $this->assertTrue(Hash::check('new-password', $me->password));
    }

    /** @test */
    public function password_must_be_correct()
    {
        $me = factory(User::class)->create(['password' => Hash::make('password')]);
        $passwordData = new PasswordData([
            'password' => 'not-a-correct-password',
            'new_password' => 'new-password',
        ]);

        try {
            (new ChangePasswordAction())->execute($me, $passwordData);
        } catch (ValidationException $e) {
            $this->assertTrue(Hash::check('password', $me->password));

            return;
        }

        $this->fail('ValidationException should be thrown, but was not.');
    }
}
