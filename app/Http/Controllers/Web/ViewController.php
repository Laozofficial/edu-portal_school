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
        return view(env('APP_THEME').'.admin.pages.index');
    }

    public function add_school_view()
    {
        return view(env('APP_THEME') . '.admin.pages.add-school');
    }

    public function all_schools_view()
    {
        return view(env('APP_THEME') . '.admin.pages.all-school');
    }

    public function school_details_views(Institution $institution)
    {
        return view(env('APP_THEME') . '.admin.pages.school_details', [
            'id' => $institution->id
        ]);
    }

    public function school_update_view(Institution $institution)
    {
        return view(env('APP_THEME') . '.admin.pages.update-school', [
            'id' => $institution->id
        ]);
    }

    public function academic_session_view()
    {
        return view(env('APP_THEME') . '.admin.pages.academic-session');
    }

    public function terms_view()
    {
        return view(env('APP_THEME') . '.admin.pages.terms');
    }

    public function classes_view()
    {
        return view(env('APP_THEME') . '.admin.pages.classes');
    }

    public function add_teacher()
    {
        return view(env('APP_THEME') . '.admin.pages.add-teachers');
    }

    public function all_teachers_view()
    {
        return view(env('APP_THEME') . '.admin.pages.all-teachers');
    }

    public function teacher_update(Teacher $teacher)
    {
        return view(env('APP_THEME') . '.admin.pages.teacher_update', [
            'slug' => $teacher->slug
        ]);
    }
}
