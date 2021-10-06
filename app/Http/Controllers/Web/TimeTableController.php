<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TimeTableController extends Controller
{
    public function time_table_view()
    {
        return view(env('APP_THEME'). '.admin.pages.time-table');
    }
}
