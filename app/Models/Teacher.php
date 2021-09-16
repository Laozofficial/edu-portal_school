<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    public function institution()
    {
        return $this->belongsTo('App\Models\Institution');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function getFullNameTextAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getFullImagePathAttribute()
    {
        $full_image_path =  url('/') . '/uploads/' . $this->image;
        return $full_image_path;
    }

    public function getDateOfBirthTextAttribute()
    {
        return Carbon::parse($this->date_of_birth)->diffForHumans();
    }

    public function getCreatedAtTextAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    protected $appends = [
        'full_name_text', 'full_image_path','date_of_birth_text', 'created_at_text'
    ];

    protected $with = [
        'user', 'country', 'state'
    ];

    protected $with = [
        'user'
    ];

}
