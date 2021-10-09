<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\Level;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{
    public function save_class(Request $request)
    {
        $level = new Level;
        $level->name = $request->get('name');
        $level->institution_id = $request->get('institution_id');
        $level->teacher_id = $request->get('teacher_id');
        $level->save();

        $response = [
            'success' => 'Class has been added'
        ];

        return response($response, 200);
    }

    public function get_single_class(Level $level)
    {
        $response = [
            'level' => $level
        ];

        return response($response, 200);
    }

    public function update_single_class(Request $request, Level $level)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);


        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422); //return error validator error
        }

        $level->name = $request->get('name');
        if($request->get('teacher_id') !== null) {
            $level->teacher_id = $request->get('teacher_id');
        }
        $level->save();

        $response = [
            'success' => 'Class has been updated'
        ];

        return response($response, 200);
    }

    public function get_students_for_class(Level $level)
    {
        $students = Student::where('level_id', $level->id)->orderBy('id', 'desc')->get();

        $response = [
            'students' => $students
        ];

        return response($response, 200);
    }

    public function get_all_classes(Institution $institution)
    {
        $levels = Level::where('institution_id', $institution->id)->orderBy('id', 'desc')->get();
        $response = [
            'levels' => $levels
        ];

        return response($response, 200);
    }
}
