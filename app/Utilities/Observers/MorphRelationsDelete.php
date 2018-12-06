<?php

namespace App\Utilities\Observers;

use App\Utilities\Observers\Contracts\MorphRelationsDeleteInterface;
use App\Utilities\Repository\Interfaces\HasMorphRelations;

class MorphRelationsDelete implements MorphRelationsDeleteInterface
{
    /**
     * @param HasMorphRelations $owner
     * @return bool|mixed
     */
    public function deleteMorphRelations(HasMorphRelations $owner)
    {
        $relations = $owner->getMorphRelations();
        foreach ($relations as $relation) {
            return $owner->{$relation} ? $owner->{$relation}->delete() : false;
        }
    }
}
