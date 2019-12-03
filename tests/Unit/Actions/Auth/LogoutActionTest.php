<?php

namespace Tests\Unit\Actions\Auth;

use Tests\TestCase;
use App\Models\User;
use App\Actions\Auth\LogoutAction;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogoutActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_logs_out_the_user()
    {
        auth()->login(factory(User::class)->create());
        $this->assertAuthenticated();

        (new LogoutAction)->execute();

        $this->assertGuest();
    }

    /** @test */
    public function it_does_nothing_if_user_is_not_authenticated()
    {
        $this->assertGuest();

        (new LogoutAction)->execute();

        $this->assertGuest();
    }
}
