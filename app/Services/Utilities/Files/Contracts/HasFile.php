<?php

namespace App\Services\Utilities\Files\Contracts;

interface HasFile
{
    /**
     * @return mixed
     */
    public function getFile();

    /**
     * @return string
     */
    public function ownerType(): string;

    /**
     * @return int
     */
    public function ownerId(): int;
}
