<?php

namespace App\Actions;

use App\Models\BookBinding;
use App\DataTransferObjects\BookBindingData;

class CreateBookBindingAction
{
    public function execute(BookBindingData $bookBindingData): BookBinding
    {
        return BookBinding::create($bookBindingData->all());
    }
}
