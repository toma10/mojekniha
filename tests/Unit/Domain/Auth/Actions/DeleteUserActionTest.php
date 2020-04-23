<?php

namespace Tests\Unit\Domain\Auth\Actions;

use App\Domain\Auth\Actions\DeleteUserAction;
use App\Domain\Auth\Models\User;
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
