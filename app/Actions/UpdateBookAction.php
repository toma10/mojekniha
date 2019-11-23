<?php

namespace App\Actions;

use App\Models\Book;
use App\DataTransferObjects\BookData;
use Illuminate\Support\Facades\Storage;

class UpdateBookAction
{
    public function execute(Book $book, BookData $bookData): Book
    {
        $data = $bookData->except('cover_image')->toArray();

        if ($bookData->cover_image) {
            Storage::disk('public')->delete($book->cover_image_path);
            $data['cover_image_path'] = $bookData->cover_image->store('book-covers', ['disk' => 'public']);
        }

        return tap($book)->update($data);
    }
}
