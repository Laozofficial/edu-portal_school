<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Level;
use App\Models\AcademicYear;
use App\Models\Subject;
use App\Models\AssessmentType;

class TeacherAssessmentController extends Controller
{
    public function get_student_records(Student $student)
    {
        $levels = Level::where('id', $student->level_id)->orderBy('id', 'desc')->get();
        $sessions = AcademicYear::where('id', $student->institution_id)->orderBy('id', 'desc')->get();
        $subjects = Subject::where('institution_id', $student->institution_id)->orderBy('id', 'desc')->get();
        $assessment_types = AssessmentType::where('institution_id', $student->institution_id)->orderBy('id', 'desc')->get();

        $response = [
            'sessions' => $sessions,
            'levels' => $levels,
            'subjects' => $subjects,
            'student' => $student,
            'assessment_types' => $assessment_types
        ];

        return response($response, 200);
    }
}
