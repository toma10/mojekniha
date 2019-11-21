<?php

namespace App\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class BookData extends DataTransferObject
{
    /** @var string */
    public $name;

    /** @var string */
    public $original_name;

    /** @var string */
    public $description;

    /** @var int */
    public $release_year;

    /** @var \Illuminate\Http\UploadedFile|null */
    public $cover_image;

    /** @var int */
    public $author_id;
}
