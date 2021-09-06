<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index_view()
    {
        return view('admin.pages.index');
    }

    public function add_school_view()
    {
        return view('admin.pages.add-school');
    }
}
