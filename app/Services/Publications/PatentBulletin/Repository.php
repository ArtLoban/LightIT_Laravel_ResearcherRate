<?php

namespace App\Services\Publications\PatentBulletin;

use App\Models\Publications\PatentBulletins\PatentBulletin;
use App\Services\Utilities\Repository\RepositoryAbstract;
use App\Services\Publications\PatentBulletin\Repository\Contracts\Repository as PatentBulletinRepository;

class Repository extends RepositoryAbstract implements PatentBulletinRepository
{
    protected function getClassName(): string
    {
        return PatentBulletin::class;
    }
}