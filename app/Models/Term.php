<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Term extends Model
{
    use HasFactory;

    const ACTIVE = 0;
    const NOT_ACTIVE = 1;

    public function academic_year()
    {
        return $this->belongsTo('App\Models\AcademicYear');
    }

    public function institution()
    {
        return $this->belongsTo('App\Models\Institution');
    }

    public function getStartDateTextAttribute()
    {
        return Carbon::parse($this->start_date)->diffForHumans();
    }

    public function getEndDateTextAttribute()
    {
        return Carbon::parse($this->end_date)->diffForHumans();
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

    public function getCreatedAtTextAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    protected $appends = [
        'start_date_text', 'end_date_text' , 'created_at_text', 'status_text'
    ];

    protected $with = [
        'academic_year'
    ];
}
