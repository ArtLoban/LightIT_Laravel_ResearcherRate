<?php

namespace App\Models\Publications\Theses;

use App\Models\App\File;
use App\Models\Users\User;
use App\Models\Publications\Author;
use Illuminate\Database\Eloquent\Model;
use App\Utilities\Files\Contracts\HasFile;
use App\Models\Publications\PublicationType;
use App\Utilities\Repository\Interfaces\Publishable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Utilities\Repository\Interfaces\HasMorphRelations;

class Thesis extends Model implements HasFile, HasMorphRelations, Publishable
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'theses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'thesis_digest_id',
        'user_id',
        'publication_type_id',
        'language',
        'year',
        'pages',
    ];

    /**
     * Get the PublicationType that owns the Thesis
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function publicationType()
    {
        return $this->belongsTo(PublicationType::class);
    }

    /**
     * Get the ThesisDigest that owns the Thesis
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thesisDigest()
    {
        return $this->belongsTo(ThesisDigest::class);
    }

    /**
     * Get the User that owns the Thesis
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The Authors that belong to the Thesis
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
