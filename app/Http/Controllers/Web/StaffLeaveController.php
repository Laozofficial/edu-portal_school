<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class StaffLeaveController extends Controller
{
    public function staff_leave()
    {
        return view(env('APP_THEME'). '.admin.pages.staff-leave');
    }

    public function leave_type()
    {
        return view(env('APP_THEME').'.admin.pages.leave-type');
    }

    public function get_leave_types(Institution $institution)
    {
        $leave_types = LeaveType::
        where('institution_id', $institution->id)
        ->orderByDesc('id')
        ->paginate(10);

        $response = [
            'leave_types' => $leave_types
        ];

        return response($response, 200);
    }

    public function save_leave_type_update(Request $request, LeaveType $leave_type)
    {
        $leave_type->name = $request->get('name');
        $leave_type->total_days = $request->get('total_days');
        $leave_type->save();

        $response = [
            'success' => 'Leave Type has been updated'
        ];

        return response($response, 200);
    }

    public function save_new_leave_type(Request $request)
    {
        $leave_type = new LeaveType;
        $leave_type->name = $request->get('name');
        $leave_type->total_days = $request->get('total_days');
        $leave_type->institution_id = $request->get('institution_id');
        $leave_type->save();

        $response = [
            'success' => 'Leave type has been added'
        ];

        return response($response, 200);
    }
}
