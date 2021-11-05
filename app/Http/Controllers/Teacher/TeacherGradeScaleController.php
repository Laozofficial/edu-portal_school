<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherGradeScaleController extends Controller
{
    public function grade_scale_view()
    {
        return view(env('APP_THEME').'.teacher.pages.grade-scale');
    }
}
