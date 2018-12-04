<?php

namespace App\Services\Users\BlankUser\Repository;

use App\Models\Users\BlankUser;
use App\Services\Utilities\Repository\RepositoryAbstract;
use App\Services\Users\BlankUser\Repository\Contracts\Repository as BlankUserRepository;

class Repository extends RepositoryAbstract implements BlankUserRepository
{
    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return BlankUser::class;
    }

    /**
     * @param int $personalKey
     * @return bool
     */
    public function checkPersonalKey(int $personalKey): bool
    {
        return $this->className::where('personal_key', $personalKey)->exists();
    }
}
