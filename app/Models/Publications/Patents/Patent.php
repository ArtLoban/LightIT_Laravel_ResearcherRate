<?php

namespace App\Models\Publications\Patents;

use App\Models\App\File;
use App\Models\Users\User;
use App\Models\Publications\Author;
use Illuminate\Database\Eloquent\Model;
use App\Services\Utilities\Files\Contracts\HasFile;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Services\Utilities\Repository\Interfaces\HasMorphRelations;

class Patent extends Model implements HasFile, HasMorphRelations
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'ipc', // International Patent Classification
        'patent_number',
        'application_number',
        'filing_date',
        'priority_date',
        'inventors',
        'user_id',
    ];

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
     * The Authors that belong to the Patent
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
