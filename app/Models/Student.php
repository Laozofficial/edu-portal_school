<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    CONST ACTIVE = 0;
    CONST ALUMNI = 1;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function institution()
    {
        return $this->belongsTo('App\Models\Institution');
    }

    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }

    public function getFullNameTextAttribute()
    {
        return $this->first_name.' '.$this->middle_name.' '.$this->last_name;
    }

    public function getCreatedAtTextAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function level()
    {
        return $this->belongsTo('App\Models\Level');
    }

    public function assessments()
    {
        return $this->hasMany('App\Models\AssessmentStudent');
    }

    public function parents()
    {
        return $this->belongsToMany('App\Models\Guardian', 'guardian_student', 'student_id','guardian_id');
    }

    public function getTypeTextAttribute()
    {
        switch ($this->type) {
            case $this::ACTIVE:
                return 'active';
            case $this::ALUMNI:
                return 'alumni';
            default:
                return 'unknown';
                break;
        }
    }

    public function assignment_answers()
    {
        return $this->hasMany('App\Models\AssignmentAnswer');
    }

    protected $appends = [
        'full_name_text', 'created_at_text', 'type_text'
    ];

    protected $with = [
      'state', 'user', 'level', 'parents'
    ];
}
