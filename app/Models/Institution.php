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
}
