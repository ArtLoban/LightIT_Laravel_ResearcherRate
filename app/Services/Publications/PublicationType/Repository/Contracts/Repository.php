<?php

namespace App\Services\Publications\PublicationType\Repository\Contracts;

use App\Services\Utilities\Repository\Interfaces\MainRepository;

interface Repository extends MainRepository
{
    /**
     * @return int
     */
    public function getScientificId(): int;

    /**
     * @return int
     */
    public function getAcademicId(): int;
}
