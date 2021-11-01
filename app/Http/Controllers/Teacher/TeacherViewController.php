<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherViewController extends Controller
{
    public function index()
    {
        return view(env('APP_THEME').'.teacher.pages.index');
    }

    public function classes()
    {
        return view(env('APP_THEME').'.teacher.pages.classes');
    }

    public function add_assessment()
    {
        return view(env('APP_THEME').'.teacher.pages.enter-assessment');
    }
}
