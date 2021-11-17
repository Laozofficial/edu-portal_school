<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institution extends Model
{
    use HasFactory, SoftDeletes;

    /*
        Define Relationships
    */


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }

    public function language()
    {
        return $this->belongsTo('App\Models\Language');
    }

    public function currency()
    {
        return $this->belongsTo('App\Models\Currency');
    }

    public function subscription()
    {
        return $this->hasOne('App\Models\Subscription');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    public function academic_sessions()
    {
        return $this->hasMany('App\Models\AcademicYear');
    }

    public function term()
    {
        return $this->hasMany('App\Models\Term');
    }

    public function leave_applications()
    {
        return $this->hasMany('App\Models\LeaveApplication');
    }

    public function students()
    {
        return $this->hasMany('App\Models\Student');
    }

    public function getFullLogoPathAttribute()
    {
        $full_logo_path =  url('/') . '/uploads/' . $this->logo;
        return $full_logo_path;
    }

    public function getCreatedAtTextAttribute()
    {
        $created_at_text = $this->created_at->diffForHumans();
        return $created_at_text;
    }

    protected $appends = [
        'full_logo_path', 'created_at_text'
    ];

    protected $with = [
        'subscription', 'country', 'currency', 'state', 'language'
    ];
}
