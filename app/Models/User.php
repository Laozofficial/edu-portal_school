<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    CONST SCHOOL_ADMIN = 0;
    CONST TEACHER = 1;
    CONST STUDENT = 2;
    CONST ADMIN = 3;
    CONST GUARDIAN = 4;


    const ACTIVE = 0;
    const NOT_ACTIVE = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function institutions()
    {
        return $this->hasMany('App\Models\Institution');
    }

    public function student()
    {
        return $this->hasOne('App\Models\Student');
    }

    public function teacher()
    {
        return $this->hasOne('App\Models\Teacher');
    }

    public function getRoleTextAttribute()
    {
        switch ($this->role) {
            case $this::SCHOOL_ADMIN:
                return 'school admin';
            case $this::TEACHER:
                return 'teacher';
            case $this::STUDENT:
                return 'student';
            case $this::ADMIN:
                return 'platform admin';
            case $this::GUARDIAN:
                return 'parent';
            default:
                return 'unknown';
                break;
        }
    }

    public function getStatusTextAttribute()
    {
        switch ($this->status) {
            case $this::ACTIVE:
                return 'active';
            case $this::NOT_ACTIVE:
                return 'banned';
            default:
                return 'unknown';
                break;
        }
    }

    public function getCreatedAtTextAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    protected $appends = [
        'role_text', 'status_text',
    ];
}
