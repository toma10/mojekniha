<?php

namespace App\Actions;

use App\DataTransferObjects\EditionData;
use App\Models\Edition;

class UpdateEditionAction
{
    /** @var UploadEditionCoverImageAction */
    protected $uploadEditionCoverImageAction;

    public function __construct(UploadEditionCoverImageAction $uploadEditionCoverImageAction)
    {
        $this->uploadEditionCoverImageAction = $uploadEditionCoverImageAction;
    }

    public function execute(Edition $edition, EditionData $editionData): Edition
    {
        $edition->update(
            $editionData->except('cover_image')->toArray()
        );

        if ($editionData->cover_image) {
            $this->uploadEditionCoverImageAction->execute($edition, $editionData->cover_image);
        }

        return $edition;
    }
}
