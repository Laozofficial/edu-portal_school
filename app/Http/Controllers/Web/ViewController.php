<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Institution;
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

    public function all_schools_view()
    {
        return view('admin.pages.all-school');
    }

    public function school_details_views(Institution $institution)
    {
        return view('admin.pages.school_details', [
            'id' => $institution->id
        ]);
    }
}
