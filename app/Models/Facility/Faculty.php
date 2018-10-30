<?php

namespace App\Models\Facility;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['name', 'slug'];

    /**
     * Get the Departments for the Faculty
     */
    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
