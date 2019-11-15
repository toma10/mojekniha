<?php

namespace App\DataTransferObjects;

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

    /** @var int */
    public $nationality_id;
}
