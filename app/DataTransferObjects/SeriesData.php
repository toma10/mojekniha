<?php

namespace App\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class SeriesData extends DataTransferObject
{
    /** @var string */
    public $name;

    /** @var int */
    public $author_id;
}
