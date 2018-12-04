<?php

namespace App\Utilities\Repository\Interfaces;

interface HasMorphRelations
{
    /**
     * @return array
     */
    public function getMorphRelations(): array;
}
