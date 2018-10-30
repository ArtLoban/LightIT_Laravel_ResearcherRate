<?php

namespace App\Models\Users;

use App\Models\Employees\Profile;
use Illuminate\Database\Eloquent\Model;

class InactiveUser extends Model
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
     * Get the Profile that owns the InactiveUser
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
