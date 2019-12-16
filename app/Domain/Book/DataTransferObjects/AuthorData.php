<?php

namespace App\Domain\Book\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class AuthorData extends DataTransferObject
{
    /** @var string */
    public $name;

    /** @var string */
    public $birth_date;

    /** @var string|null */
    public $death_date;

    /** @var string|null */
    public $biography;

    /** @var \Illuminate\Http\UploadedFile|null */
    public $portrait_image;

    /** @var int */
    public $nationality_id;
}
