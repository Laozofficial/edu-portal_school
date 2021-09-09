<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;


    const ACTIVE = 0;
    const NOT_ACTIVE = 1;

    public function institution()
    {
        return $this->belongsTo('App\Models\Institution');
    }

    public function getStatusTextAttribute()
    {
        switch ($this->status) {
            case $this::ACTIVE:
                return 'active';
            case $this::NOT_ACTIVE:
                return 'banned';
            default:
                return 'unknown';
                break;
        }
    }

    protected $appends = [
        'status_text'
    ];
}
