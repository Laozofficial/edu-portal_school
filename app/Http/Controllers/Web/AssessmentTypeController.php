<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AssessmentType;
use App\Models\Institution;
use Illuminate\Http\Request;

class AssessmentTypeController extends Controller
{
    public function assessment_types()
    {
        return view(env('APP_THEME').'.admin.pages.assessment_types');
    }

    public function get_assessment_type(Institution $institution)
    {
        $assessment_types = AssessmentType::where('institution_id', $institution->id)->orderBy('id', 'desc')->get();
        $response = [
            'assessment_types' => $assessment_types
        ];
        return response($response, 200);
    }

    public function get_single_assessment(AssessmentType $assessment_type)
    {
        $response = [
            'assessment_type' => $assessment_type
        ];

        return response($response, 200);
    }

    public function save_assessment(Request $request, Institution $institution)
    {
        $assessment_type = new AssessmentType;
        $assessment_type->name = $request->get('name');
        $assessment_type->max_mark = $request->get('max_mark');
        $assessment_type->institution_id = $institution->id;
        $assessment_type->save();

        $response = [
            'success' => 'Assessment has been added Successful'
        ];

        return response($response, 200);
    }

    public function save_update_assessment(Request $request, AssessmentType $assessment_type)
    {
        $assessment_type->name = $request->get('name');
        $assessment_type->max_mark = $request->get('max_mark');
        $assessment_type->save();

        $response = [
            'success' => 'Assessment has been updated Successfully'
        ];

        return response($response, 200);
    }
}
