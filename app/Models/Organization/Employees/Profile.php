<?php

namespace App\Models\Organization\Employees;

use App\Models\Organization\Facility\Department;
use App\Models\Users\BlankUser;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'patronymic',
        'birth_date',
        'position_id',
        'ac_degree_id',
        'ac_title_id',
        'department_id',
    ];

    /**
     * Get the AcademicDegree that owns the Profile
     */
    public function academicDegree()
    {
        return $this->belongsTo(AcademicDegree::class, 'ac_degree_id');
    }

    /**
     * Get the AcademicTitle that owns the Profile
     */
    public function academicTitle()
    {
        return $this->belongsTo(AcademicTitle::class, 'ac_title_id');
    }

    /**
     * Get the Position that owns the Profile
     */
    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    /**
     * Get the Department that owns the Profile
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the Inactive User associated with the Profile
     */
    public function inactiveUser()
    {
        return $this->hasOne(BlankUser::class);
    }

    /**
     * Get the User that owns the Profile
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
