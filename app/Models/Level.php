<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Level extends Model
{
    use HasFactory;

    const ACTIVE = 0;
    const NOT_ACTIVE = 1;

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

    public function institution()
    {
        return $this->belongsTo('App\Models\Institution');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }

    public function getCreatedAtTextAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function students()
    {
        return $this->belongsToMany('App\Models\Student', 'level_student', 'student_id', 'level_id')->withPivot('active');
    }

    protected $appends = [
        'status_text', 'created_at_text'
    ];

    protected $with = [
        'institution', 'teacher'
    ];
}
