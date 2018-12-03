<?php

namespace App\Models\Publications\Articles;

use App\Models\App\File;
use App\Models\Users\User;
use App\Models\Publications\Author;
use Illuminate\Database\Eloquent\Model;
use App\Models\Publications\PublicationType;
use App\Services\Utilities\Files\Contracts\HasFile;
use App\Models\Publications\Articles\Journal\Journal;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Services\Utilities\Repository\Interfaces\Publishable;
use App\Services\Utilities\Repository\Interfaces\HasMorphRelations;

class Article extends Model implements HasFile, HasMorphRelations, Publishable
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
        'language',
        'description',
        'user_id',
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
     * Get the User that owns the Article
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The Authors that belong to the Article
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @return string
     */
    public function ownerType(): string
    {
        return get_class($this);
    }

    /**
     * @return int
     */
    public function ownerId(): int
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getMorphRelations(): array
    {
        return ['file'];
    }
}