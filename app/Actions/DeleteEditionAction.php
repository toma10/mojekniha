<?php

namespace App\Actions;

use App\Models\Edition;

class DeleteEditionAction
{
    public function execute(Edition $edition): void
    {
        $edition->delete();
    }
}
