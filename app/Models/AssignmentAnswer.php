<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentAnswer extends Model
{
    use HasFactory;

    public function assignment()
    {
        return $this->belongsTo('App\Models\Assignment');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function getAssignmentPathTextAttribute()
    {
        return  url('/') . '/uploads/' . $this->assignment_solution_path;
    }

    public function getSubmissionDateTextAttribute()
    {
        return $this->created_at->isoFormat('llll');
    }

    protected $appends = [
        'assignment_path_text', 'submission_date_text'
    ];

    protected $with = [
        'assignment', 'student'
    ];
}
