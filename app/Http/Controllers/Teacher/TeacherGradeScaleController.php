<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\GradeScale;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherGradeScaleController extends Controller
{
    public function grade_scale_view()
    {
        return view(env('APP_THEME').'.teacher.pages.grade-scale');
    }

    public function get_grade_scale()
    {
        $teacher =  Teacher::where('user_id', Auth::user()->id)->first();

        $grade_scale = GradeScale::where('institution_id', $teacher->institution_id)->orderBy('id', 'desc')->get();

        $response = [
            'grade_scale' => $grade_scale
        ];

        return response($response, 200);
    }
}
