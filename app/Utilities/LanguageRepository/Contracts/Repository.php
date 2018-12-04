<?php

namespace App\Utilities\LanguageRepository\Contracts;

interface Repository
{
    /**
     * @return array|null
     */
    public function all(): ?array;
}
