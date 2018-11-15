<?php

namespace App\Services\Utilities\LanguageRepository\Contracts;

interface Repository
{
    /**
     * @return array|null
     */
    public function all(): ?array;
}
