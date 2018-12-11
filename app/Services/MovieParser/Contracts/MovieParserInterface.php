<?php

namespace App\Services\MovieParser\Contracts;

interface MovieParserInterface
{
    /**
     * @return array
     */
    public function getData(): array;
}
