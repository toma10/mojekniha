<?php

namespace Tests\Unit\Actions;

use Tests\TestCase;
use App\Models\Author;
use App\Actions\CreateBookAction;
use App\DataTransferObjects\BookData;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateBookActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_book()
    {
        $author = factory(Author::class)->create();
        $bookData = new BookData([
            'name' => 'Hlava XXII',
            'original_name' => 'Catch-22',
            'description' => 'Hlavní postavou je poručík letectva Yossarian, který je trochu klaun a trochu blázen.',
            'release_year' => 1961,
            'author_id' => $author->id,
        ]);

        $book = (new CreateBookAction())->execute($bookData);

        $this->assertEquals($bookData->name, $book->name);
        $this->assertEquals($bookData->original_name, $book->original_name);
        $this->assertEquals($bookData->description, $book->description);
        $this->assertEquals($bookData->release_year, $book->release_year);
        $this->assertEquals($bookData->author_id, $book->author_id);
    }
}
