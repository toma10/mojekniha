<?php

namespace App\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class EditionData extends DataTransferObject
{
    /** @var int */
    public $book_id;

    /** @var string */
    public $isbn;

    /** @var int */
    public $release_year;

    /** @var int */
    public $language_id;

    /** @var int */
    public $number_of_pages;

    /** @var int */
    public $number_of_copies;

    /** @var int */
    public $book_binding_id;

    /** @var \Illuminate\Http\UploadedFile|null */
    public $cover_image;
}
