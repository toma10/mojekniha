<?php

namespace Tests\Unit\Actions\Auth;

use App\Actions\UpdateProfileAction;
use App\DataTransferObjects\ProfileData;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateProfileActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_update_profile()
    {
        $me = factory(User::class)->create();
        $profileData = new ProfileData([
            'name' => 'John Doe',
            'username' => 'johndoe',
        ]);

        $me = (new UpdateProfileAction())->execute($me, $profileData);

        $this->assertEquals('John Doe', $me->name);
        $this->assertEquals('johndoe', $me->username);
    }
}
