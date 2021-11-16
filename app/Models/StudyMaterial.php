<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyMaterial extends Model
{
    use HasFactory;

    public function institution()
    {
        return $this->belongsTo('App\Models\Institution');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }

    public function level()
    {
        return $this->belongsTo('App\Models\Level');
    }

    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }

    public function getCreatedAtTextAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function academic_year()
    {
        return $this->belongsTo('App\Models\AcademicYear');
    }

    public function getMaterialPathFullTextAttribute()
    {
        return  url('/') . '/uploads/' . $this->path;
    }

    protected $with = [
        'institution', 'teacher', 'subject', 'academic_year', 'level'
    ];

    protected $appends = [
        'created_at_text', 'material_path_full_text'
    ];
}
