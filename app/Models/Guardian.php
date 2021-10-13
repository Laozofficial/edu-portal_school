<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function students()
    {
        return $this->belongsToMany('App\Models\Student', 'guardian_student', 'guardian_id', 'student_id');
    }

    protected $with = [
        'user'
    ];

}
