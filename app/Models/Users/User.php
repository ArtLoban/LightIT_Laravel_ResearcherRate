<?php

namespace App\Models\Users;

use App\Models\Organization\Employees\Profile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the Profile associated with the User
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Get the Role that owns the User
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
