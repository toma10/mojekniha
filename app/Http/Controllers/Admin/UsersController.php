<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Auth\Actions\UpdateUserAction;
use App\Domain\Auth\DataTransferObjects\UserData;
use App\Domain\Auth\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class UsersController
{
    public function index(): Response
    {
        $users = User::paginate();

        return Inertia::render('Users/Index', compact('users'));
    }

    public function create()
    {
    }

    public function store()
    {
    }

    public function show(User $user): Response
    {
        return Inertia::render('Users/Show', compact('user'));
    }

    public function edit(User $user): Response
    {
        return Inertia::render('Users/Edit', compact('user'));
    }

    public function update(User $user, UserRequest $request, UpdateUserAction $updateUserAction): RedirectResponse
    {
        $updateUserAction->execute(
            $user,
            new UserData($request->validated())
        );

        flash()->success(trans('messages.user.updated'));

        return redirect()->route('admin.users.edit', $user);
    }

    public function destroy()
    {
    }
}
