<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\GradeScale;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GradeScaleController extends Controller
{
    public function grade_scale_view()
    {
        return view(env('APP_THEME') . '.admin.pages.grade_scale');
    }

    public function save_grade(Request $request, Institution $institution)
    {
        $validator = Validator::make($request->all(), [
            'grade' => 'required',
            'lower_value' => 'required|integer',
            'upper_value' => 'required|integer',
        ]);


        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422); //return error validator error
        }

        $grade = new GradeScale;
        $grade->grade = $request->get('grade');
        $grade->lower_value = $request->get('lower_value');
        $grade->upper_value = $request->get('upper_value');
        $grade->institution_id = $institution->id;
        $grade->save();

        $response = [
            'success' => 'Grade has been added successfully'
        ];

        return response($response, 200);
    }

    public function get_grades(Institution $institution)
    {
        $grades = GradeScale::where('institution_id', $institution->id)->orderBy('grade', 'asc')->get();
        $response = [
            'grades' => $grades
        ];

        return response($response, 200);
    }

    public function get_single_grade(GradeScale $grade)
    {
        $response = [
            'grade' => $grade
        ];

        return response($response, 200);
    }

    public function save_update_grade(Request $request, GradeScale $grade)
    {
        $validator = Validator::make($request->all(), [
            'grade' => 'required',
            'lower_value' => 'required|integer',
            'upper_value' => 'required|integer',
        ]);


        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422); //return error validator error
        }

        $grade->grade = $request->get('grade');
        $grade->lower_value = $request->get('lower_value');
        $grade->upper_value = $request->get('upper_value');
        $grade->save();

        $response = [
            'success' => 'Grade has been updated successfully'
        ];

        return response($response, 200);
    }

    public function delete_grade(GradeScale $grade)
    {
        $grade->delete();

        $response = [
            'success' => 'Grade Has been deleted Successfully'
        ];

        return response($response, 200);
    }
}
