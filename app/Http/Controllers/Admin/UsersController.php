<?php

namespace App\Http\Controllers\Admin;

use App\Domain\User\Actions\CreateUserAction;
use App\Domain\User\Actions\DeleteUserAction;
use App\Domain\User\Actions\UpdateUserAction;
use App\Domain\User\DataTransferObjects\CreateUserData;
use App\Domain\User\DataTransferObjects\UpdateUserData;
use App\Domain\User\Models\User;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
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

    public function create(): Response
    {
        return Inertia::render('Users/Create');
    }

    public function store(CreateUserRequest $request, CreateUserAction $createUserAction): RedirectResponse
    {
        $createUserAction->execute(CreateUserData::fromRequest($request));

        flash()->success(trans('messages.user.created'));

        return redirect()->route('admin.users.index');
    }

    public function show(User $user): Response
    {
        return Inertia::render('Users/Show', compact('user'));
    }

    public function edit(User $user): Response
    {
        return Inertia::render('Users/Edit', compact('user'));
    }

    public function update(User $user, UpdateUserRequest $request, UpdateUserAction $updateUserAction): RedirectResponse
    {
        $updateUserAction->execute($user, UpdateUserData::fromRequest($request));

        flash()->success(trans('messages.user.updated'));

        return redirect()->route('admin.users.edit', $user);
    }

    public function destroy(User $user, DeleteUserAction $deleteUserAction): RedirectResponse
    {
        $deleteUserAction->execute($user);

        flash()->success(trans('messages.user.deleted'));

        return redirect()->route('admin.users.index');
    }
}
