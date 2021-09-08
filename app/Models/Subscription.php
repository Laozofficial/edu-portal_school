<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    const ACTIVE = 1;
    const DISABLED = 0;


    public function institution()
    {
        return $this->belongsTo('App\Models\Institution');
    }

    public function getStatusTextAttribute()
    {
        switch ($this->status) {
            case $this::ACTIVE:
                return 'Active';
            case $this::DISABLED:
                return 'Disabled';
            default:
                return 'Unknown';
        }
    }

    protected $appends = [
        'status_text'
    ];

}
