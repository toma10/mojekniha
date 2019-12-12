<?php

namespace App\Actions;

use App\DataTransferObjects\BookBindingData;
use App\Models\BookBinding;

class CreateBookBindingAction
{
    public function execute(BookBindingData $bookBindingData): BookBinding
    {
        return BookBinding::create($bookBindingData->all());
    }
}
