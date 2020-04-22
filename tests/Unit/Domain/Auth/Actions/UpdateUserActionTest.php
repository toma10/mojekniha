<?php

namespace Tests\Unit\Domain\Auth\Actions;

use App\Domain\Auth\Actions\UpdateUserAction;
use App\Domain\Auth\DataTransferObjects\UserData;
use App\Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateUserActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_the_user()
    {
        $user = factory(User::class)->create();
        $userData = new UserData([
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
        ]);

        $user = app(UpdateUserAction::class)->execute($user, $userData);

        $this->assertEquals($userData->name, $user->name);
        $this->assertEquals($userData->username, $user->username);
        $this->assertEquals($userData->email, $user->email);
    }
}
