<?php

namespace App\Models\Publications\PatentBulletins;

use App\Models\Publications\Patents\Patent;
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
