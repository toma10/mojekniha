<?php

namespace App\Domain\Book\Actions;

use App\Domain\Book\Models\BookBinding;

class DeleteBookBindingAction
{
    public function execute(BookBinding $bookBinding): void
    {
        $bookBinding->delete();
    }
}
