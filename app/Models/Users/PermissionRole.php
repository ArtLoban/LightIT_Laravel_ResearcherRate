<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['permission_id', 'role_id'];

    /**
     * Get the Role that owns the PermissionRole
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the Permission that owns the PermissionRole
     */
    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
