<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Level;

class TeacherStudentController extends Controller
{
    public function students()
    {
        return view(env('APP_THEME').'.teacher.pages.students');
    }

    public function get_students_from_class(Level $level)
    {
        $students = Student::where('level_id', $level->id)->paginate(50);

        $response = [
            'students' => $students
        ];

        return response($response, 200);
    }
}
