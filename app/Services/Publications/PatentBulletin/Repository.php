<?php

namespace App\Services\Publications\PatentBulletin;

use App\Models\Publications\PatentBulletins\PatentBulletin;
use App\Services\Utilities\Repository\RepositoryAbstract;
use App\Services\Publications\PatentBulletin\Repository\Contracts\Repository as PatentBulletinRepository;
use Illuminate\Database\Eloquent\Collection;

class Repository extends RepositoryAbstract implements PatentBulletinRepository
{
    protected function getClassName(): string
    {
        return PatentBulletin::class;
    }

    /**
     * @return Collection|null
     */
    public function allSortedByDateField(): ?Collection
    {
        return $this->className::all()->sortByDesc('date');
    }
}