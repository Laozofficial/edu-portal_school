<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function institution()
    {
        return $this->belongsTo('App\Models\Institution');
    }

    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }

    public function getFullNameTextAttribute()
    {
        return $this->first_name.' '.$this->middle_name.' '.$this->last_name;
    }

    public function getCreatedAtTextAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function level()
    {
        return $this->belongsTo('App\Models\Level');
    }

    protected $appends = [
        'full_name_text', 'created_at_text'
    ];

    protected $with = [
      'state', 'user', 'level'
    ];
}
