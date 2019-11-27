<?php

namespace App\Actions;

use App\Models\Edition;
use App\DataTransferObjects\EditionData;

class UpdateEditionAction
{
    public function execute(Edition $edition, EditionData $editionData): Edition
    {
        return tap($edition)->update($editionData->all());
    }
}
