<?php

namespace App\Services\Publications\Patents\PatentBulletin\Repository\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Services\Utilities\Repository\Interfaces\MainRepository;

interface Repository extends MainRepository
{
    /**
     * @return Collection|null
     */
    public function allSortedByDateField(): ?Collection;
}
