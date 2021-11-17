<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveApplication extends Model
{
    use HasFactory;

    const PENDING = 0;
    const APPROVED = 1;
    const DECLINED = 2;


    public function getStatusTextAttribute()
    {
        switch ($this->status) {
            case $this::PENDING:
                return 'pending';
            case $this::APPROVED:
                return 'approved';
            case $this::DECLINED:
                return 'declined';
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

    public function academic_year()
    {
        return $this->belongsTo('App\Models\AcademicYear');
    }

    public function leave_type()
    {
        return $this->belongsTo('App\Models\LeaveType');
    }

    protected $appends = [
        'status_text'
    ];

    protected $with = [
        'institution', 'teacher', 'academic_year', 'leave_type'
    ];


}
