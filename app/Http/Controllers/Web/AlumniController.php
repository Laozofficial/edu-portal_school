<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function alumni_view()
    {
        return view(env('APP_THEME').'.admin.pages.alumni');
    }
}
