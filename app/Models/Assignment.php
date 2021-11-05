<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }

    public function term()
    {
        return $this->belongsTo('App\Models\Term');
    }

    public function academic_year()
    {
        return $this->belongsTo('App\Models\AcademicYear');
    }

    public function level()
    {
        return $this->belongsTo('App\Models\Level');
    }

    public function institution()
    {
        return $this->belongsTo('App\Models\Institution');
    }

    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }

    public function getSubmissionDateTextAttribute()
    {
        return Carbon::parse($this->submission_date)->isoFormat('llll');
    }

    public function getCreatedAtTextAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getFullPathLinkAttribute()
    {
        return  url('/') . '/uploads/' . $this->path;
    }

    public function assignment_answers()
    {
        return $this->hasMnay('App\Models\AssignmentAnswer');
    }

    protected $appends = [
        'submission_date_text', 'full_path_link', 'created_at_text'
    ];

    protected $with = [
        'teacher', 'term', 'academic_year', 'level', 'institution', 'subject'
    ];
}
