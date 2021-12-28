<?php

namespace App\Http\Controllers\Admin;

use App\Domain\User\Actions\UpdateUserAction;
use App\Domain\User\DataTransferObjects\UpdateUserData;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController
{
    public function index(Request $request): Response
    {
        return Inertia::render('Profile', ['user' => $request->user()]);
    }

    public function store(UpdateUserRequest $request, UpdateUserAction $updateUserAction): RedirectResponse
    {
        $updateUserAction->execute($request->user(), UpdateUserData::fromRequest($request));

        flash()->success(trans('messages.profile.updated'));

        return back();
    }
}
