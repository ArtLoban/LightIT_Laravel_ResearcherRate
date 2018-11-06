<?php

namespace App\Helpers\Hasher\Contracts;

interface HasherInterface
{
    /**
     * @param string $string
     * @return string
     */
    public function make(string $string): string;
}
