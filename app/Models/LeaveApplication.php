<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getStatusClassTextAttribute()
    {
        switch ($this->status) {
            case $this::PENDING:
                return 'text-warning';
            case $this::APPROVED:
                return 'text-success';
            case $this::DECLINED:
                return 'text-danger';
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

    public function getEndLeaveDateTextAttribute()
    {
        return Carbon::parse($this->end_leave_date)->isoFormat('llll');
    }

    public function getStartLeaveDateTextAttribute()
    {
        return Carbon::parse($this->start_leave_date)->isoFormat('llll');
    }

    public function getLeaveAttachmentPathAttribute()
    {
        return  url('/') . '/uploads/' . $this->leave_attachment;
    }

    public function getDifferenceInDaysTextAttribute()
    {
        $start_date = Carbon::parse($this->start_leave_date);
        $end_date = Carbon::parse($this->end_leave_date);

        $difference = $start_date->diffInDays($end_date);
        return $difference. ' days leave';
    }

    public function getCreatedAtTextAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getApprovedAtTextAttribute()
    {
       if($this->approved_at)  return Carbon::parse($this->approved_at)->diffForHumans();
    }

    protected $appends = [
        'status_text', 'end_leave_date_text', 'start_leave_date_text', 'difference_in_days_text', 'leave_attachment_path', 'status_class_text', 'approved_at_text', 'created_at_text'
    ];

    protected $with = [
        'institution', 'teacher', 'academic_year', 'leave_type'
    ];


}
