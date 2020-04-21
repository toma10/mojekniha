<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Auth\Models\User;
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

    public function show()
    {
    }

    public function edit()
    {
    }

    public function update()
    {
    }

    public function destroy()
    {
    }
}
