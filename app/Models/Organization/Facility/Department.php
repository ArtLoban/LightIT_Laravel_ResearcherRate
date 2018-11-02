<?php

namespace App\Models\Organization\Facility;

use App\Models\Organization\Employees\Profile;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use Sluggable;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'faculty_id'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * Get the Faculty that owns the Department
     */
    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    /**
     * Get the Profiles for the Department
     */
    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }
}
