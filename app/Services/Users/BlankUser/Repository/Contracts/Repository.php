<?php

namespace App\Services\Users\BlankUser\Repository\Contracts;

interface Repository
{
    /**
     * @param int $personalKey
     * @return bool
     */
    public function checkPersonalKey(int $personalKey): bool;
}
