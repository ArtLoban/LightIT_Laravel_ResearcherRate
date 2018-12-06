<?php

namespace App\Models\Publications\Theses;

use Illuminate\Database\Eloquent\Model;

class ThesisDigest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'isbn',
        'language',
        'year',
        'pages',
    ];

    /**
     * Get the Theses for the ThesisDigest
     */
    public function theses()
    {
        return $this->hasMany(Thesis::class);
    }
}