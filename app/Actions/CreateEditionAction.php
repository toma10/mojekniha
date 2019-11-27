<?php

namespace App\Actions;

use App\Models\Edition;
use App\DataTransferObjects\EditionData;

class CreateEditionAction
{
    protected $uploadEditionCoverImageAction;

    public function __construct(UploadEditionCoverImageAction $uploadEditionCoverImageAction)
    {
        $this->uploadEditionCoverImageAction = $uploadEditionCoverImageAction;
    }

    public function execute(EditionData $editionData): Edition
    {
        $edition = Edition::create(
            $editionData->except('cover_image')->toArray()
        );

        if ($editionData->cover_image) {
            $this->uploadEditionCoverImageAction->execute($edition, $editionData->cover_image);
        }

        return $edition;
    }
}
