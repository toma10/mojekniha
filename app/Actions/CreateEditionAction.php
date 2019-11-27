<?php

namespace App\Actions;

use App\Models\Edition;
use App\DataTransferObjects\EditionData;

class CreateEditionAction
{
    public function execute(EditionData $editionData): Edition
    {
        return Edition::create($editionData->all());
    }
}
