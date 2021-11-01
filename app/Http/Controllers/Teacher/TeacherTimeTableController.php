<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicYear;
use App\Models\Institution;
use App\Models\Level;
use App\Models\Teacher;
use App\Models\Term;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\TimeTable;

class TeacherTimeTableController extends Controller
{
    public function time_table()
    {
        return view(env('APP_THEME').'.teacher.pages.time-table');
    }

    public function get_other_details()
    {
        $institution = Teacher::where('user_id', Auth::user()->id)->first();

        $sessions = AcademicYear::where('institution_id', $institution->institution_id)->orderBy('id', 'desc')->get();
        $levels = Level::where('teacher_id', $institution->id)->orderBy('id', 'desc')->get();

        $response = [
            'sessions' => $sessions,
            'levels' => $levels,
        ];

        return response($response, 200);
    }

    public function get_terms_from_academic_session(Session $session)
    {
        $terms = Term::where('academic_year_id', $session->id)->get();
        $response = [
            'terms' => $terms
        ];

        return response($response, 200);
    }

    public function get_time_tables(Request $request)
    {
        $institution = Teacher::where('user_id', Auth::user()->id)->first();

        $query = TimeTable::where('institution_id', $institution->institution_id);

        if ($request->get('session')) {
            $query->where('academic_year_id', $request->get('session'));
        }
        if ($request->get('level')) {
            $query->where('level_id', $request->get('level'));
        }
        if ($request->get('term')) {
            $query->where('term_id', $request->get('term'));
        }
        $time_tables =  $query->orderBy('id', 'desc')->get();

        $response = [
            'time_tables' => $time_tables
        ];

        return response($response, 200);
    }
}
