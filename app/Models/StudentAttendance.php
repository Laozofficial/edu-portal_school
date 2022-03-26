<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    use HasFactory;

    public function institution_attendance()
    {
        return $this->belongsTo('App\Models\InstitutionAttendance');
    }
}
