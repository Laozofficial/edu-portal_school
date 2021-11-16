<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherStudyMaterialController extends Controller
{
    public function study_material_view()
    {
        return view(env('APP_THEME'). 'teacher.pages.study-materials');
    }
}
