<?php

namespace Tests\Unit\Actions;

use Tests\TestCase;
use App\Models\Book;
use App\Actions\UpdateBookAction;
use App\DataTransferObjects\BookData;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateBookActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_the_book()
    {
        $book = factory(Book::class)->create();
        $bookData = new BookData([
            'name' => '1984',
            'original_name' => 'Nineteen Eighty-Four',
            'description' => '1984, dnes již klasické dílo antiutopického žánru, je bezesporu jedním z nejpozoruhodnějších románů 20. století a brilantní analýzou všech totalitních systémů.',
            'release_year' => 1949,
        ]);

        $book = (new UpdateBookAction())->execute($book, $bookData);

        $this->assertEquals($bookData->name, $book->name);
        $this->assertEquals($bookData->original_name, $book->original_name);
        $this->assertEquals($bookData->description, $book->description);
        $this->assertEquals($bookData->release_year, $book->release_year);
    }
}
