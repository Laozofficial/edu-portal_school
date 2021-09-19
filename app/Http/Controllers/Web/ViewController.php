<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index_view()
    {
        return view('easy_school.admin.pages.index');
    }

    public function add_school_view()
    {
        return view('easy_school.admin.pages.add-school');
    }

    public function all_schools_view()
    {
        return view('easy_school.admin.pages.all-school');
    }

    public function school_details_views(Institution $institution)
    {
        return view('easy_school.admin.pages.school_details', [
            'id' => $institution->id
        ]);
    }

    public function school_update_view(Institution $institution)
    {
        return view('easy_school.admin.pages.update-school', [
            'id' => $institution->id
        ]);
    }

    public function academic_session_view()
    {
        return view('easy_school.admin.pages.academic-session');
    }

    public function terms_view()
    {
        return view('easy_school.admin.pages.terms');
    }

    public function classes_view()
    {
        return view('easy_school.admin.pages.classes');
    }

    public function add_teacher()
    {
        return view('easy_school.admin.pages.add-teachers');
    }

    public function all_teachers_view()
    {
        return view('easy_school.admin.pages.all-teachers');
    }

    public function teacher_update(Teacher $teacher)
    {
        return view('easy_school.admin.pages.teacher_update', [
            'slug' => $teacher->slug
        ]);
    }
}
