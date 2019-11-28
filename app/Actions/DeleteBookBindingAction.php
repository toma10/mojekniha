<?php

namespace App\Actions;

use App\Models\BookBinding;

class DeleteBookBindingAction
{
    public function execute(BookBinding $bookBinding): void
    {
        $bookBinding->delete();
    }
}
