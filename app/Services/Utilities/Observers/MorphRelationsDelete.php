<?php

namespace App\Services\Utilities\Observers;

use App\Services\Utilities\Observers\Contracts\MorphRelationsDeleteInterface;
use App\Services\Utilities\Repository\Interfaces\HasMorphRelations;

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
