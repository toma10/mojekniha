<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_determine_if_is_admin()
    {
        $user = factory(User::class)->create(['is_admin' => false]);
        $admin = factory(User::class)->create(['is_admin' => true]);

        $this->assertFalse($user->isAdmin());
        $this->assertTrue($admin->isAdmin());
    }
}
