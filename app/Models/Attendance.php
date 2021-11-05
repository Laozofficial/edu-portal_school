<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    CONST PRESENT = 0;
    CONST ABSENT = 1;

    public function getAttendanceStatusTextAttribute()
    {
        switch ($this->status) {
            case $this::PRESENT:
                return 'present';
            case $this::ABSENT:
                return 'absent';
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

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function level()
    {
        return $this->belongsTo('App\Models\Level');
    }

    public function academic_year()
    {
        return $this->belongsTo('App\Models\AcademicYear');
    }

    public function term()
    {
        return $this->belongsTo('App\Models\Term');
    }

    public function getDateRecordedTextAttribute()
    {
        return Carbon::parse($this->date_recorded)->isoFormat('llll');
    }

    protected $appends = [
        'attendance_status_text', 'date_recorded_text'
    ];

    protected $with = [
        'institution', 'level', 'term', 'academic_year', 'student', 'teacher'
    ];
}
