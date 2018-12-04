<?php

namespace App\Models\Organization\Employees;

use Illuminate\Database\Eloquent\Model;

class AcademicDegree extends Model
{
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get the Profiles for the AcademicDegree
     */
    public function profiles()
    {
        return $this->hasMany(Profile::class, 'ac_degree_id');
    }
}
