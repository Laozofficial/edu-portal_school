<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeScale extends Model
{
    use HasFactory;

    public function getCreatedAtTextAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    protected $appends = [
        'created_at_text'
    ];
}
