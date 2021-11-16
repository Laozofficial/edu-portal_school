<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherLeaveController extends Controller
{
    public function staff_leave_view()
    {
        return view(env('APP_THEME').'.teacher.pages.leave');
    }
}
