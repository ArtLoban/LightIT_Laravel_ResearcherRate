<?php

namespace App\Services\Publications\Services\PublicationService\Contracts;

use Illuminate\Http\UploadedFile;
use App\Services\Utilities\Files\Contracts\HasFile;
use App\Services\Utilities\Repository\Interfaces\Publishable;

interface PublicationServiceInterface
{
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