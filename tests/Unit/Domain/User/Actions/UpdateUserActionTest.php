<?php

namespace Tests\Unit\Domain\User\Actions;

use App\Domain\User\Actions\UpdateUserAction;
use App\Domain\User\DataTransferObjects\UpdateUserData;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateUserActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_the_user()
    {
        $user = factory(User::class)->create();
        $userData = new UpdateUserData([
            'name' => 'John Doe',
            'username' => 'johndoe',
        ]);

        $user = app(UpdateUserAction::class)->execute($user, $userData);

        $this->assertEquals($userData->name, $user->name);
        $this->assertEquals($userData->username, $user->username);
    }
}
