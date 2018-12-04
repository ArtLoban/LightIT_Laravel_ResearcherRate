<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get the PermissionRoles for the Permission
     */
    public function permissionRoles()
    {
        return $this->hasMany(PermissionRole::class);
    }
}
