<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\StudyMaterial;
use Illuminate\Http\Request;

class StudyMaterialController extends Controller
{
    public function study_materials()
    {
        return view(env('APP_THEME'). '.admin.pages.study-materials');
    }

    public function get_study_materials(Institution $institution)
    {
        $materials = StudyMaterial::where('institution_id', $institution->id)->paginate(20);

        $response = [
            'materials' => $materials
        ];

        return response($response, 200);
    }
}
