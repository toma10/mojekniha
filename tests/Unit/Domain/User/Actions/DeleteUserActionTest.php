<?php

namespace Tests\Unit\Domain\User\Actions;

use App\Domain\User\Actions\DeleteUserAction;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteUserActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_the_user()
    {
        $user = factory(User::class)->create();

        (new DeleteUserAction())->execute($user);

        $this->assertDeleted($user);
    }
}
