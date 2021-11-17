<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffLeaveController extends Controller
{
    public function staff_leave()
    {
        return view(env('APP_THEME'). '.admin.pages.staff-leave');
    }
}
