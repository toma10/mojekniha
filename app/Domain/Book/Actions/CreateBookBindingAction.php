<?php

namespace App\Domain\Book\Actions;

use App\Domain\Book\DataTransferObjects\BookBindingData;
use App\Domain\Book\Models\BookBinding;

class CreateBookBindingAction
{
    public function execute(BookBindingData $bookBindingData): BookBinding
    {
        return BookBinding::create($bookBindingData->all());
    }
}
