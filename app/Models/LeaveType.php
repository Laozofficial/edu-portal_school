<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;

    public function leave_applications()
    {
        return $this->hasMany('App\Models\LeaveApplication')->orderBy('id', 'desc')->get();
    }


    protected $with = [
        // 'leave_applications'
    ];

    protected $appends = [

    ];
}
