<?php

namespace App\Helpers\Hasher;

use App\Helpers\Hasher\Contracts\HasherInterface;
use Illuminate\Contracts\Hashing\Hasher;

class HasherService implements HasherInterface
{
    /**
     * @var Hasher
     */
    private $hasher;

    /**
     * HasherService constructor.
     * @param Hasher $hasher
     */
    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;
    }

    /**
     * @param string $string
     * @return string
     */
    public function make(string $string): string
    {
        return $this->hasher->make($string);
    }
}
