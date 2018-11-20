<?php

namespace App\Models\Publications\Articles\Journal;

use Illuminate\Database\Eloquent\Model;

class JournalType extends Model
{
    /**
     * Get the Journals for the Repository
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function journals()
    {
        return $this->hasMany(Journal::class);
    }
}
