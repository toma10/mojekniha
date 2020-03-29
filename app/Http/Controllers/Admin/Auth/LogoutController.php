<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Domain\Auth\Actions\LogoutAction;
use Illuminate\Http\RedirectResponse;

class LogoutController
{
    public function __invoke(LogoutAction $logoutAction): RedirectResponse
    {
        $logoutAction->execute('web');

        return redirect()->route('admin.auth.login');
    }
}
