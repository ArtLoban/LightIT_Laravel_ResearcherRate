<?php

namespace App\Services\Organization\Employees\Profile\Repository\Contracts;

use App\Models\Organization\Employees\Profile;
use App\Services\Utilities\Repository\Interfaces\MainRepository;
use Illuminate\Support\Collection;

interface Repository extends MainRepository
{
    public function getProfilesBySameDepartment(?Profile $profile, array $relations): Collection;
}
