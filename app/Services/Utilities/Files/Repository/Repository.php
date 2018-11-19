<?php

namespace App\Services\Utilities\Files\Repository;

use App\Models\App\File;
use App\Services\Utilities\Repository\RepositoryAbstract;
use App\Services\Utilities\Files\Repository\Contracts\Repository as FileRepository;

class Repository extends RepositoryAbstract implements FileRepository
{
    protected function getClassName(): string
    {
        return File::class;
    }
}
