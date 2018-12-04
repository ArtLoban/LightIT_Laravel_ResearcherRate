<?php

namespace App\Utilities\Observers\Contracts;

use App\Utilities\Repository\Interfaces\HasMorphRelations;

interface MorphRelationsDeleteInterface
{
    /**
     * @param HasMorphRelations $owner
     * @return mixed
     */
    public function deleteMorphRelations(HasMorphRelations $owner);
}
