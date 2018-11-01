<?php

namespace App\Models\Organization\Employees;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get the Profiles for the Position
     */
    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }
}
