<?php

namespace App\Services\Users\BlankUser\KeyGenerator\Contracts;

interface KeyGenerator
{
    /**
     * @return int
     */
    public function generate(): int;
}
