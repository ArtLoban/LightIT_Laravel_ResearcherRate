<?php

namespace App\Models\Publications;

use App\Models\Publications\Articles\Article;
use Illuminate\Database\Eloquent\Model;

class PublicationType extends Model
{
    /**
     * Get the Articles for the PublicationType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
