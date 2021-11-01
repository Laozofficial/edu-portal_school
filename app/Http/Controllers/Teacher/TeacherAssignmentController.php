<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherAssignmentController extends Controller
{
    public function assignment_view()
    {
        return view(env('APP_THEME').'.teacher.pages.assignment');
    }
}
