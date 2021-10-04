<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelStudent extends Model
{
    use HasFactory;

    protected $table = 'level_student';

    public function level()
    {
        return $this->belongsTo('App\Models\Level');
    }

    protected $with = [
        'level'
    ];

}
