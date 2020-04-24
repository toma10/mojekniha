<?php

namespace App\Http\Controllers\Admin;

use App\Domain\User\Actions\ChangePasswordAction;
use App\Domain\User\DataTransferObjects\PasswordData;
use App\Http\Requests\PasswordRequest;
use Illuminate\Http\RedirectResponse;

class ChangePasswordController
{
    public function __invoke(PasswordRequest $request, ChangePasswordAction $changePasswordAction): RedirectResponse
    {
        $changePasswordAction->execute(
            $request->user(),
            new PasswordData($request->validated())
        );

        flash()->success(trans('messages.password.changed'));

        return back();
    }
}
