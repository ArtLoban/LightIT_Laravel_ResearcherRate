<?php

namespace App\Models\Publications\Articles\Article;

use App\Models\Publications\Author;
use Illuminate\Database\Eloquent\Model;
use App\Models\Publications\PublicationType;
use App\Models\Publications\Articles\Journal\Journal;

class Article extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'journal_id',
        'publication_type_id',
        'journal_number',
        'year',
        'pages',
        'language_id',
    ];

    /**
     * Get the PublicationType that owns the Article
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function publicationType()
    {
        return $this->belongsTo(PublicationType::class);
    }

    /**
     * Get the Journal that owns the Article
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function journal()
    {
        return $this->belongsTo(Journal::class);
    }

    /**
     * The Authors that belong to the Article
     */
    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }
}
