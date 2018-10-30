<?php

namespace App\Models\Facility;

use App\Models\Employees\Profile;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'faculty_id'];

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
