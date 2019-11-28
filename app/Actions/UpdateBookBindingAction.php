<?php

namespace App\Actions;

use App\Models\BookBinding;
use App\DataTransferObjects\BookBindingData;

class UpdateBookBindingAction
{
    public function execute(BookBinding $bookBinding, BookBindingData $bookBindingData): BookBinding
    {
        return tap($bookBinding)->update($bookBindingData->all());
    }
}
