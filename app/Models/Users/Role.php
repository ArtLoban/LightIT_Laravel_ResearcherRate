<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const USER = 1;
    const ADMIN = 2;
    const SENIOR_ADMIN = 3;
    const SUPER_ADMIN = 4;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get the Users for the Role
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the PermissionRoles for the Role
     */
    public function permissionRoles()
    {
        return $this->hasMany(PermissionRole::class);
    }
}
