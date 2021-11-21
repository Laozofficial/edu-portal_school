<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudyMaterialController extends Controller
{
    public function study_materials()
    {
        return view(env('APP_THEME'). '.admin.pages.study-materials');
    }
}
