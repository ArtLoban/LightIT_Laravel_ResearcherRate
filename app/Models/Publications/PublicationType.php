<?php

namespace App\Models\Publications;

use Illuminate\Database\Eloquent\Model;
use App\Models\Publications\Articles\Article\Article;

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
