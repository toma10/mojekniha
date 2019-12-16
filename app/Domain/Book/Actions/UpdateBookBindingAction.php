<?php

namespace App\Domain\Book\Actions;

use App\Domain\Book\DataTransferObjects\BookBindingData;
use App\Domain\Book\Models\BookBinding;

class UpdateBookBindingAction
{
    public function execute(BookBinding $bookBinding, BookBindingData $bookBindingData): BookBinding
    {
        return tap($bookBinding)->update($bookBindingData->all());
    }
}
