<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;

    public function academic_year()
    {
        return $this->belongsTo('App\Models\AcademicYear');
    }

    public function institution()
    {
        return $this->belongsTo('App\Models\Institution');
    }

    protected $with = [
        'academic_year'
    ];
}
