<?php

namespace App\Models\Publications;

use Illuminate\Database\Eloquent\Model;
use App\Models\Publications\Theses\Thesis;
use App\Models\Publications\Articles\Article;

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

    /**
     * Get the Theses for the PublicationType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function theses()
    {
        return $this->hasMany(Thesis::class);
    }
}
