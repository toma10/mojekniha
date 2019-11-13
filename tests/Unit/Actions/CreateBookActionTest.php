<?php

namespace Tests\Unit\Actions;

use Tests\TestCase;
use App\Models\Book;
use App\Actions\CreateBookAction;
use App\DataTransferObjects\BookData;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateBookActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_book()
    {
        $bookData = new BookData(factory(Book::class)->raw());

        $book = (new CreateBookAction())->execute($bookData);

        $this->assertEquals($bookData->name, $book->name);
        $this->assertEquals($bookData->original_name, $book->original_name);
        $this->assertEquals($bookData->description, $book->description);
        $this->assertEquals($bookData->release_year, $book->release_year);
    }
}
