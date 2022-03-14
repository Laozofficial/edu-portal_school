<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\AcademicSessionScope;

class AcademicYear extends Model
{
    use HasFactory;


    const ACTIVE = 0;
    const NOT_ACTIVE = 1;

    protected static function booted()
    {
        static::addGlobalScope(new AcademicSessionScope);
    }

    public function institution()
    {
        return $this->belongsTo('App\Models\Institution');
    }

    public function terms()
    {
        return $this->hasMany('App\Models\Term');
    }

    public function getStatusTextAttribute()
    {
        switch ($this->status) {
            case $this::ACTIVE:
                return 'active';
            case $this::NOT_ACTIVE:
                return 'not active';
            default:
                return 'unknown';
                break;
        }
    }

    public function getStartDateTextAttribute()
    {
        return Carbon::parse($this->start_date)->diffForHumans();
    }

    public function getEndDateTextAttribute()
    {
        return Carbon::parse($this->end_date)->diffForHumans();
    }

    public function getCreatedAtTextAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    // public function assessment_student()
    // {
    //     return $this->hasMany('App\Models\AssessmentStudent');
    // }

    protected $appends = [
        'status_text','start_date_text', 'end_date_text', 'created_at_text'
    ];
}
