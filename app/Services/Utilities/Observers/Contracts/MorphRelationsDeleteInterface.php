<?php

namespace App\Services\Utilities\Observers\Contracts;

use App\Services\Utilities\Repository\Interfaces\HasMorphRelations;

interface MorphRelationsDeleteInterface
{
    /**
     * @param HasMorphRelations $owner
     * @return mixed
     */
    public function deleteMorphRelations(HasMorphRelations $owner);
}
