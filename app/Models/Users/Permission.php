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
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    private static $permissions = [
        'fullAccess',
        'accessAdminPanel',
        'seeDashboard',
    ];

    /**
     * Get the PermissionRoles for the Permission
     */
    public function permissionRoles()
    {
        return $this->hasMany(PermissionRole::class);
    }

    /**
     * @return array
     */
    public static function getPermissions(): array
    {
        return self::$permissions;
    }
}
