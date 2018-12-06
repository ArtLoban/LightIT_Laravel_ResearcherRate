<?php

namespace App\Models\Publications;

use App\Models\Publications\Articles\Article;
use App\Models\Publications\Theses\Thesis;
use Illuminate\Database\Eloquent\Model;
use App\Models\Publications\Patents\Patent;
use App\Models\Organization\Employees\Profile;

class Author extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'profile_id',
    ];

    /**
     * Get the Profile that owns the Author
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    /**
     * The Articles that belong to the Author
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    /**
     * The Patents that belong to the Author
     */
    public function patents()
    {
        return $this->belongsToMany(Patent::class);
    }

    /**
     * The Theses that belong to the Author
     */
    public function theses()
    {
        return $this->belongsToMany(Thesis::class);
    }
}
