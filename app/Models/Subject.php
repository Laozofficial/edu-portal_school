<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public function getCreatedAtTextAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function level()
    {
        return $this->belongsTo('App\Models\Level');
    }

    protected $appends = [
        'created_at_text'
    ];

    protected $with = [
        'level'
    ];
}
