<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherLoginController extends Controller
{
    public function login_view()
    {
        return view(env('APP_THEME').'.Teacher.pages.auth.login');
    }
}
