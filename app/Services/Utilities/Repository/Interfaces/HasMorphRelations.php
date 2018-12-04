<?php

namespace App\Services\Utilities\Repository\Interfaces;

interface HasMorphRelations
{
    /**
     * @return array
     */
    public function getMorphRelations(): array;
}
