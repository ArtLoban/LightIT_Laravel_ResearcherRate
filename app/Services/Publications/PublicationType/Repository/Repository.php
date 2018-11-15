<?php

namespace App\Services\Publications\PublicationType\Repository;

use App\Models\Publications\PublicationType;
use App\Services\Utilities\Repository\RepositoryAbstract;
use App\Services\Publications\PublicationType\Repository\Contracts\Repository as PublicationTypeRepository;

class Repository extends RepositoryAbstract implements PublicationTypeRepository
{
    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return PublicationType::class;
    }
}
