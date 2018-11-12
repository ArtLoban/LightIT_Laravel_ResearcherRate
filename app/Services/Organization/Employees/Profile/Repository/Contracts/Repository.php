<?php

namespace App\Services\Organization\Employees\Profile\Repository\Contracts;

use Illuminate\Support\Collection;
use App\Models\Organization\Employees\Profile;

interface Repository
{
    /**
     * @param Profile|null $profile
     * @param array $relations
     * @return Collection
     */
    public function getProfilesBySameDepartment(?Profile $profile): Collection;
}
