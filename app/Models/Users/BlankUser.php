<?php

namespace App\Models\Users;

use App\Models\Organization\Employees\Profile;
use Illuminate\Database\Eloquent\Model;

class BlankUser extends Model
{
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'personal_key',
        'profile_id',
    ];

    /**
     * Get the Profile that owns the BlankUser
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}

