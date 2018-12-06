<?php

namespace App\Utilities\Files\Repository;

use App\Models\App\File;
use App\Utilities\Repository\RepositoryAbstract;
use App\Utilities\Files\Repository\Contracts\Repository as FileRepository;

class Repository extends RepositoryAbstract implements FileRepository
{
    protected function getClassName(): string
    {
        return File::class;
    }
}
