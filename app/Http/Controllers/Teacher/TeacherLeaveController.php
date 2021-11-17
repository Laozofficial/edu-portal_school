<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\LeaveApplication;
use App\Models\LeaveType;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TeacherLeaveController extends Controller
{
    private $teacher;

    public function __construct()
    {
        $this->teacher = Teacher::select(['id', 'user_id', 'institution_id'])->get();
    }

    public function staff_leave_view()
    {
        return view(env('APP_THEME'). '.teacher.pages.staff-leave');
    }

    public function get_details_for_leave()
    {
        $teacher = $this->teacher->firstWhere('user_id', Auth::user()->id);
        $leave_types = LeaveType::where('institution_id', $teacher->institution_id)->orderBy('id', 'desc')->get();
        $sessions = AcademicYear::where('institution_id', $teacher->institution_id)->orderBy('id', 'desc')->get();

        $response = [
            'leave_types' => $leave_types,
            'sessions' => $sessions,
        ];

        return response($response, 200);
    }

    public function get_leave_application()
    {
        $teacher = $this->teacher->firstWhere('user_id', Auth::user()->id);
        $leave_applications = LeaveApplication::where('teacher_id', $teacher->id)->orderBy('id','desc')->paginate(10);

        $response = [
            'leaves' => $leave_applications
        ];

        return response($response, 200);
    }

    public function apply_for_leave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'leave_start_date' => 'required|date|after:now',
            'leave_end_date' => 'required|date|after:leave_start_date',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422); //return error validator error
        }

        $get_leave_type = LeaveType::firstWhere('id', $request->get('leave_type'));//get leave type

        $start_date = Carbon::parse($request->get('leave_start_date'));
        $end_date = Carbon::parse($request->get('leave_end_date'));

        $leave_days = $start_date->diffInDays($end_date); //get the days between dates in the leave application

        if($leave_days > (int)$get_leave_type->total_days) {
            $response = [
                'errors' => ['You can only apply for a '.$get_leave_type->total_days. ' '.$get_leave_type->name.' (Leave)' ]
            ];

            return response($response, 422);
        }


        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $leave = new LeaveApplication;
        $leave->institution_id = $teacher->institution_id;
        $leave->teacher_id = $teacher->id;
        $leave->academic_year_id = $request->get('session');
        $leave->leave_type_id = $request->get('leave_type');
        $leave->start_leave_date = Carbon::parse($request->get('leave_start_date'));
        $leave->end_leave_date = Carbon::parse($request->get('leave_end_date'));
        $leave->leave_reason = $request->get('leave_reason');
        if ($request->hasFile('leave_letter')) {
            $mt = $request->file('leave_letter');
            $extension = $mt->getClientOriginalExtension(); // you can also use file name
            $the_file =   Auth::user()->id . $request->get('session_id') . time() . '.' . $extension;
            $path = Env('PUBLIC_IMAGE_PATH');
            $upload = $mt->move($path, $the_file);

            $leave->leave_attachment = $the_file;
        }
        $leave->save();

        $response = [
            'success' => 'Leave Application has been submitted'
        ];

        return response($response, 200);
    }

    public function delete_leave_application(LeaveApplication $leave)
    {
        if($leave->status == 0) {
            $leave->delete();
            $response = [
                'success' => 'Leave Application has been Deleted'
            ];

            return response($response, 200);
        }else {
            $response = [
                'errors' => ['You cannot delete a Leave Application unless it\'s stil pending']
            ];

            return response($response, 400);
        }
    }
}
