<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    use HasFactory;

    public function institution()
    {
        return $this->belongsTo('App\Models\Institution');
    }

    public function level()
    {
        return $this->belongsTo('App\Models\Level');
    }

    public function term()
    {
        return $this->belongsTo('App\Models\Term');
    }

    public function academic_year()
    {
        return $this->belongsTo('App\Models\AcademicYear');
    }

    public function getDownloadLinkAttribute()
    {
        return  url('/') . '/uploads/' . $this->file;
    }

    protected $with = [
        'level', 'term', 'academic_year'
    ];

    protected $appends = [
        'download_link'
    ];
}
