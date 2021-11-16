<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\StudyMaterial;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherStudyMaterialController extends Controller
{
    public function study_material_view()
    {
        return view(env('APP_THEME'). '.teacher.pages.study-materials');
    }

    public function get_materials()
    {
        $teacher  = Teacher::where('user_id', Auth::user()->id)->first();
        $materials = StudyMaterial::where('teacher_id', $teacher->id)->orderBy('id', 'desc')->paginate(10);

        $response = [
            'materials' => $materials,
        ];

        return response($response, 200);
    }
}
