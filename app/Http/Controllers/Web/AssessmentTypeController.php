<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\AssessmentStudent;
use App\Models\AssessmentType;
use App\Models\Institution;
use Illuminate\Http\Request;
use App\Models\Level;
use App\Models\Student;
use App\Models\Subject;

class AssessmentTypeController extends Controller
{
    public function assessment_types()
    {
        return view(env('APP_THEME').'.admin.pages.assessment_types');
    }

    public function add_assessment()
    {
        return view(env('APP_THEME').'.admin.pages.student-assessment');
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

    public function get_details_to_assessment(Institution $institution, Student $student)
    {
        $levels = Level::where('id', $student->level_id)->orderBy('id', 'desc')->get();
        $sessions = AcademicYear::where('institution_id', $institution->id)->orderBy('id', 'desc')->get();
        $subjects = Subject::where('institution_id', $institution->id)->orderBy('id', 'desc')->get();
        $assessment_types = AssessmentType::where('institution_id', $institution->id)->orderBy('id', 'desc')->get();

        $response = [
            'sessions' => $sessions,
            'levels' => $levels,
            'subjects' => $subjects,
            'student' => $student,
            'assessment_types' => $assessment_types
        ];

        return response($response, 200);

    }

    public function save_student_assessments(Request $request)
    {

        $check_assessments = AssessmentType::where('id', $request->get('assessment_type_id'))->first();

        if ($request->get('score') > $check_assessments->max_mark) {
            $response = [
                'error' => 'Assessment Score Cannot be More than '. $check_assessments->max_mark. ' mark'
            ];

            return response($response, 400);
        }

        $student_assessment = new AssessmentStudent;
        $student_assessment->academic_year_id = $request->get('academic_year_id');
        $student_assessment->level_id = $request->get('level_id');
        $student_assessment->term_id = $request->get('term_id');
        $student_assessment->student_id = $request->get('student_id');
        $student_assessment->institution_id = $request->get('institution_id');
        $student_assessment->subject_id = $request->get('subject_id');
        $student_assessment->assessment_type_id = $request->get('assessment_type_id');
        $student_assessment->score = $request->get('score');
        $student_assessment->save();

        $response = [
            'success' => 'Assessment has been added to the Student Record'
        ];

        return response($response, 200);
    }

    public function get_student_assessments(Student $student)
    {
        $assessment_types = AssessmentStudent::where('student_id', $student->id)->paginate(30);
        $response = [
            'assessments' => $assessment_types
        ];

        return response($response, 200);
    }

    public function single_assessment_view(Student $student)
    {
        return view(env('APP_THEME'). '.admin.pages.single_student_assessment', [
            'id' => $student->id
        ]);
    }
}
