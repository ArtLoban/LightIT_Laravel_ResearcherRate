<?php

namespace App\Services\Publications\Patents\PatentBulletin\Repository;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Publications\Patents\PatentBulletin;
use App\Utilities\Repository\RepositoryAbstract;
use App\Services\Publications\Patents\PatentBulletin\Repository\Contracts\Repository as PatentBulletinRepository;

class Repository extends \App\Utilities\Repository\RepositoryAbstract implements PatentBulletinRepository
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
