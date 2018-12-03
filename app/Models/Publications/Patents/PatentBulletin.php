<?php

namespace App\Models\Publications\Patents;

use Illuminate\Database\Eloquent\Model;

class PatentBulletin extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'week',
        'year',
        'date',
    ];

    /**
     * @var array
     */
    protected $dates = ['date'];

    /**
     * Get the Patents for the PatentBulletin
     */
    public function patents()
    {
        return $this->hasMany(Patent::class);
    }
}