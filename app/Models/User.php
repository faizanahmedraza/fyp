<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles, Notifiable;

    protected $table = "users";
    protected $guard_name = 'web';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id',
        'first_name',
        'last_name',
        'father_name',
        'cnic',
        'email',
        'password',
        'profile_picture',
        'profile_detail',
        'student_rollno',
        'student_seatno',
        'contact',
        'gender',
        'dob',
        'department',
        'designation',
        'qualification',
        'expertise',
        'certification',
        'joining_date',
        'verification_token',
        'remember_token',
        'is_block',
        'is_verified',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getProfilePictureAttribute($value)
    {
        return !empty($value)?$value:"not_available.jpg";
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function  getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
