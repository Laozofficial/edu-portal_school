<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentHomeWorkController extends Controller
{
    private $student;

    public function __construct()
    {
        $this->student = Student::select(['id', 'user_id', 'institution_id', 'created_at', 'level_id'])->withoutGlobalScopes()->get();
    }

    public function home_work()
    {
        return view(env('APP_THEME').'.student.pages.home-work');
    }

    public function get_student_home_work()
    {
        $student = $this->student->firstWhere('user_id', auth()->user()->id);
        $assignments = Assignment::where('level_id', $student->level_id)->orderByDesc('created_at')->paginate(15);

        $response = [
            'assignments' => $assignments
        ];

        return response($response, 200);
    }
}
