<?php

namespace App\Actions;

use App\DataTransferObjects\BookBindingData;
use App\Models\BookBinding;

class UpdateBookBindingAction
{
    public function execute(BookBinding $bookBinding, BookBindingData $bookBindingData): BookBinding
    {
        return tap($bookBinding)->update($bookBindingData->all());
    }
}
