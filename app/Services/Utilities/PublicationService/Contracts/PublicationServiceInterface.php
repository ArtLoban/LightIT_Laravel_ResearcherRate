<?php

namespace App\Services\Utilities\PublicationService\Contracts;

use Illuminate\Http\UploadedFile;
use App\Services\Utilities\Files\Contracts\HasFile;
use App\Services\Utilities\Repository\Interfaces\Publishable;
use App\Services\Utilities\Repository\Interfaces\MainRepository;

interface PublicationServiceInterface
{
    /**
     * @param string $editionName
     * @param MainRepository $repository
     * @return int
     */
    public function getEditionIdByName(string $editionName, MainRepository $repository): int;

    /**
     * @param string $authors
     * @param Publishable $publication
     */
    public function assignAuthors(string $authors, Publishable $publication): void;

    /**
     * @param UploadedFile $file
     * @param HasFile $publication
     * @return mixed
     */
    public function storeFile(UploadedFile $file, HasFile $publication);
}
