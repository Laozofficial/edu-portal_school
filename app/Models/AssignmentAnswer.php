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
}
