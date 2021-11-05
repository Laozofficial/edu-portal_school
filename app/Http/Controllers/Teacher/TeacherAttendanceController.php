<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Attendance;
use App\Models\Teacher;

class TeacherAttendanceController extends Controller
{
    public function student_attendance()
    {
        return view(env('APP_THEME').'.teacher.pages.student-attendance');
    }

    public function save_attendance(Request $request, Student $student)
    {
        $validator = Validator::make($request->all(), [
            'session_id' => 'required',
            'term_id' => 'required',
            'level_id' => 'required',
            'status' => 'required',
            'date_recorded' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422); //return error validator error
        }

        $teacher = Teacher::where('user_id', Auth::user()->id)->first();

        $check_attendance = Attendance::where('student_id', $student->id)
                                        ->where('teacher_id', $teacher->id)
                                        ->where('level_id', $request->get('level_id'))
                                        ->where('academic_year_id', $request->get('session_id'))
                                        ->where('term_id', $request->get('term_id'))
                                        ->where('institution_id', $teacher->institution_id)
                                        ->where('date_recorded', $request->get('date_recorded'))
                                        ->first();

        if($check_attendance){
            $response = [
                'error' => 'An identical Attendance is already on the system'
            ];

            return response($response, 400);
        }

        $attendance  = new Attendance;
        $attendance->teacher_id = $teacher->id;
        $attendance->student_id = $student->id;
        $attendance->level_id = $request->get('level_id');
        $attendance->academic_year_id = $request->get('session_id');
        $attendance->term_id = $request->get('term_id');
        $attendance->institution_id = $teacher->institution_id;
        $attendance->status = $request->get('status');
        $attendance->date_recorded =  $request->get('date_recorded');
        $attendance->save();

        $response = [
            'success' => 'Attendance has been recorded'
        ];

        return response($response, 200);
    }
}
