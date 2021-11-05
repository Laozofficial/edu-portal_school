<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Level;
use App\Models\AcademicYear;
use App\Models\AssessmentStudent;
use App\Models\Subject;
use App\Models\AssessmentType;
use Illuminate\Support\Facades\Validator;

class TeacherAssessmentController extends Controller
{
    public function get_student_records(Student $student)
    {
        $levels = Level::where('id', $student->level_id)->orderBy('id', 'desc')->get();
        $sessions = AcademicYear::where('institution_id', $student->institution_id)->orderBy('id', 'desc')->get();
        $subjects = Subject::where('institution_id', $student->institution_id)->orderBy('id', 'desc')->get();
        $assessment_types = AssessmentType::where('institution_id', $student->institution_id)->orderBy('id', 'desc')->get();

        $response = [
            'sessions' => $sessions,
            'levels' => $levels,
            'subjects' => $subjects,
            'student' => $student,
            'assessment_types' => $assessment_types,
        ];

        return response($response, 200);
    }

    public function save_assessments(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'session_id' => 'required',
            'assessment_type_id' => 'required',
            'level_id' => 'required',
            'subject_id' => 'required',
            'term_id' => 'required',
            'score' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422); //return error validator error
        }

        $student = Student::where('id', $request->get('student_id'))->first();
        $check_assessments = AssessmentType::where('id', $request->get('assessment_type_id'))->first();

        if ($request->get('score') > $check_assessments->max_mark) {
            $response = [
                'error' => 'Assessment Score Cannot be More than ' . $check_assessments->max_mark . ' mark'
            ];

            return response($response, 400);
        }

        $check_student_assessment = AssessmentStudent::where('institution_id', $student->institution_id)
                                    ->where('academic_year_id', $request->get('academic_year_id'))
                                    ->where('level_id', $request->get('level_id'))
                                    ->where('student_id', $request->get('student_id'))
                                    ->where('assessment_type_id', $request->get('assessment_type_id'))
                                    ->where('term_id', $request->get('term_id'))
                                    ->where('subject_id', $request->get('subject_id'))
                                    ->first();

        if ($check_student_assessment) {
            $response = [
                'error' => 'This assessment has been added previously '
            ];

            return response($response, 400);

       }else {
            $assessment = new AssessmentStudent;
            $assessment->academic_year_id = $request->get('session_id');
            $assessment->assessment_type_id = $request->get('assessment_type_id');
            $assessment->level_id = $request->get('level_id');
            $assessment->subject_id = $request->get('subject_id');
            $assessment->term_id = $request->get('term_id');
            $assessment->score = $request->get('score');
            $assessment->student_id = $request->get('student_id');
            $assessment->institution_id = $student->institution_id;
            $assessment->save();

            $response = [
                'success' => 'Assessment has been added Successfully'
            ];

            return response($response, 200);
       }
    }

    public function get_assessment_records(Student $student)
    {
        $assessments = AssessmentStudent::where('student_id', $student->id)->orderBy('id', 'desc')->paginate(10);
        $response = [
            'assessments' => $assessments
        ];

        return response($response, 200);
    }
}
