<?php

namespace App\Services\Users\BlankUser\Repository\Contracts;

use App\Services\Utilities\Repository\Interfaces\MainRepository;

interface Repository extends MainRepository
{
    /**
     * @param int $personalKey
     * @return bool
     */
    public function checkPersonalKey(int $personalKey): bool;
}
