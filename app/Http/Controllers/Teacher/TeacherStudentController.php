<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Guardian;
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

    public function student_record_view(Student $student)
    {
        return view(env('APP_THEME').'.teacher.pages.student-records', [
            'id' => $student->id
        ]);
    }

    public function get_student_info(Student $student)
    {
        $response = [
            'student' => $student
        ];

        return response($response, 200);
    }

    public function get_student_parents(Student $student)
    {
        $parents = Guardian::where('user_id', $student->user_id)->get();

        $response = [
            'parents' => $parents
        ];

        return response($response, 200);
    }
}
