<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitutionAttendance extends Model
{
    use HasFactory;

    public function institution()
    {
        return $this->belongsTo('App\Models\Institution');
    }

    public function term()
    {
        return $this->belongsTo('App\Models\Term');
    }

    public function session()
    {
        return $this->belongsTo('App\Models\AcademicYear', 'academic_year_id');
    }

    public function getCreatedAtTextAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    protected $with = ['institution', 'term', 'session'];

    protected $appends = ['created_at_text'];

}
