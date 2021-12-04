<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentViewController extends Controller
{
    public function login_view()
    {
        return view(env('APP_THEME').'.student.pages.auth.login');
    }

    public function index()
    {
        return view(env('APP_THEME').'.student.pages.index');
    }
}
