<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentStudent extends Model
{
    use HasFactory;

    protected $table = 'assessment_students';

    public function academic_year()
    {
        return $this->belongsTo('App\Models\AcademicYear');
    }

    public function level()
    {
         return $this->belongsTo('App\Models\Level');
    }

    public function term()
    {
        return $this->belongsTo('App\Models\Term');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function institution()
    {
        return $this->belongsTo('App\Models\Institution');
    }

    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }

    public function assessment_type()
    {
        return $this->belongsTo('App\Models\AssessmentType');
    }

    public function getCreatedAtTextAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    protected $with = [
        'academic_year', 'level', 'term',  'institution', 'subject', 'student', 'assessment_type'
    ];

    protected $appends = [
        'created_at_text'
    ];
}
