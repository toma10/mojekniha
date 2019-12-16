<?php

namespace App\Domain\Book\Actions;

use App\Domain\Book\Models\Edition;

class DeleteEditionAction
{
    public function execute(Edition $edition): void
    {
        $edition->delete();
    }
}
