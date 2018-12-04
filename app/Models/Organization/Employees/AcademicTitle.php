<?php

namespace App\Models\Organization\Employees;

use Illuminate\Database\Eloquent\Model;

class AcademicTitle extends Model
{
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get the Profiles for the AcademicTitle
     */
    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }
}
