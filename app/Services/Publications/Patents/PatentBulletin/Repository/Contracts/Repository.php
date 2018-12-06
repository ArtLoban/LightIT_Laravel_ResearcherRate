<?php

namespace App\Services\Publications\Patents\PatentBulletin\Repository\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Utilities\Repository\Interfaces\MainRepository;

interface Repository extends MainRepository
{
    /**
     * @return Collection|null
     */
    public function allSortedByDateField(): ?Collection;
}
