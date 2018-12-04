<?php

namespace App\Services\Publications\Theses\ThesisDigest\Repository;

use App\Models\Publications\Theses\ThesisDigest;
use App\Utilities\Repository\RepositoryAbstract;
use App\Services\Publications\Theses\ThesisDigest\Repository\Contracts\Repository as ThesesRepository;

class Repository extends RepositoryAbstract implements ThesesRepository
{
    protected function getClassName(): string
    {
        return ThesisDigest::class;
    }
}
