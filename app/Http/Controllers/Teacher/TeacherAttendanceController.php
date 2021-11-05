<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class TeacherAttendanceController extends Controller
{
    public function student_attendance()
    {
        return view(env('APP_THEME').'.teacher.pages.student-attendance');
    }

    public function save_attendance(Request $request, Student $student)
    {

    }
}
