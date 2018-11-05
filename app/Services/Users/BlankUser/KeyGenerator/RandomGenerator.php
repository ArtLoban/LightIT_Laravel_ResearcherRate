<?php

namespace App\Services\Users\BlankUser\KeyGenerator;

use App\Services\Users\BlankUser\KeyGenerator\Contracts\KeyGenerator;
use App\Services\Users\BlankUser\Repository\Contracts\Repository as BlankUserRepository;

class RandomGenerator implements KeyGenerator
{
    const MIN = 10000000;
    const MAX = 99999999;

    /**
     * @var BlankUserRepository
     */
    private $blankUserRepository;

    /**
     * RandomGenerator constructor.
     * @param BlankUserRepository $blankUserRepository
     */
    public function __construct(BlankUserRepository $blankUserRepository)
    {
        $this->blankUserRepository = $blankUserRepository;
    }

    /**
     * @return int
     */
    public function generate(): int
    {
        $result = mt_rand(self::MIN, self::MAX);

        if ($this->checkGeneratedNumber($result)) {
            $this->generate();
        }

        return $result;
    }

    /**
     *  Check if such key is already exists in DB
     *
     * @param int $personalKey
     * @return bool
     */
    private function checkGeneratedNumber(int $personalKey): bool
    {
        return $this->blankUserRepository->checkPersonalKey($personalKey);
    }
}
