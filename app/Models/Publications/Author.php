<?php

namespace App\Models\Publications;

use Illuminate\Database\Eloquent\Model;
use App\Models\Organization\Employees\Profile;
use App\Models\Publications\Articles\Article\Article;

class Author extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
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
    public function article()
    {
        return $this->belongsToMany(Article::class);
    }
}
