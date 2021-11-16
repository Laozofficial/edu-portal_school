<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\StudyMaterial;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    public function save_material(Request $request)
    {
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();

        $material = new StudyMaterial;
        $material->institution_id = $teacher->institution_id;
        $material->teacher_id = $teacher->id;
        $material->level_id = $request->get('level_id');
        $material->academic_year_id = $request->get('session_id');
        $material->subject_id = $request->get('subject_id');
        $material->title = $request->get('title');
        $material->description = $request->get('description');
        if ($request->hasFile('material')) {
            $mt = $request->file('material');
            $extension = $mt->getClientOriginalExtension(); // you can also use file name
            $the_file =   Auth::user()->id . $request->get('session_id') . time() . '.' . $extension;
            $path = Env('PUBLIC_IMAGE_PATH');
            $upload = $mt->move($path, $the_file);

            $material->path = $the_file;
        }
        $material->save();

        $response = [
            'success' => 'Material has been added Successfully'
        ];

        return response($response, 200);
    }

    public function delete_material(StudyMaterial $material)
    {
        $material->delete();
        $response = [
            'success' => 'Material has been deleted Successfully'
        ];

        return response($response, 200);
    }
}
