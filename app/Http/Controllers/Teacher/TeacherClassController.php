<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use App\Models\Level;
use App\Models\Student;
use App\Models\Subject;

class TeacherClassController extends Controller
{
    public function teacher_classes()
    {
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $classes =  Level::where('teacher_id', $teacher->id)->get();

        $response = [
            'classes' => $classes
        ];

        return response($response, 200);
    }

    public function get_level_students(Level $level)
    {
        $students = Student::where('level_id', $level->id)->paginate(30);
        $response = [
            'students' => $students
        ];

        return response($response, 200);
    }

    public function teacher_get_subjects(Level $level)
    {
        $subjects = Subject::where('level_id', $level->id)->orderBy('name', 'desc')->get();

        $response = [
            'subjects' =>  $subjects
        ];

        return response($response, 200);
    }
}
