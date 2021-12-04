<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\AssessmentStudent;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAssessmentController extends Controller
{
    private $student;

    public function __construct()
    {
        $this->student = Student::select(['id', 'user_id', 'institution_id', 'created_at'])->withoutGlobalScopes()->get();
    }

    public function student_assessments()
    {
        return view(env('APP_THEME').'.student.pages.assessments');
    }

    public function get_student_assessments()
    {
        $student =  $this->student->firstWhere('user_id', auth()->user()->id);
        $assessments = AssessmentStudent::where('student_id', $student->id)->paginate(15);

        $response = [
            'assessments' => $assessments
        ];

        return response($response, 200);
    }
}
