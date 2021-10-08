<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Models\Institution;
use App\Models\Level;
use App\Models\Term;
use App\Models\TimeTable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TimeTableController extends Controller
{
    public function time_table_view()
    {
        return view(env('APP_THEME'). '.admin.pages.time-table');
    }

    public function get_other_details(Institution $institution)
    {
        $sessions = AcademicYear::where('institution_id', $institution->id)->orderBy('id', 'desc')->get();
        $levels = Level::where('institution_id', $institution->id)->orderBy('id', 'desc')->get();

        $response = [
            'sessions' => $sessions,
            'levels' => $levels,
        ];

        return response($response, 200);
    }

    public function get_terms_from_academic_session(AcademicYear $session)
    {
        $terms = Term::where('academic_year_id', $session->id)->orderBy('id', 'desc')->get();

        $response = [
            'terms' => $terms
        ];

        return response($response, 200);
    }

    public function save_time_table(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'time_table' => 'required|mimes:doc,pdf,docx',
        ]);


        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422); //return error validator error
        }

        $time_table = new TimeTable;
        $time_table->institution_id = $request->get('institution_id');
        $time_table->academic_year_id = $request->get('session');
        $time_table->level_id = $request->get('level');
        $time_table->term_id = $request->get('term');
        if ($request->hasFile('time_table')) {
            $tt = $request->file('time_table');
            $extension = $tt->getClientOriginalExtension(); // you can also use file name
            $the_file =   Auth::user()->id . $request->get('session') . time() . '.' . $extension;
            $path = Env('PUBLIC_IMAGE_PATH');
            $upload = $tt->move($path, $the_file);

            $time_table->file = $the_file;
        }
        $time_table->save();

        $response = [
            'success' => 'Time Table has been Saved'
        ];

        return response($response, 200);
    }

    public function get_time_tables(Request $request, Institution $institution)
    {
        $query = TimeTable::where('institution_id', $institution->id);

        if($request->get('session') ) {
            $query->where('academic_year_id', $request->get('session'));
        }
        if($request->get('level')) {
            $query->where('level_id', $request->get('level'));
        }
        if($request->get('term')) {
            $query->where('term_id', $request->get('term'));
        }
        $time_tables =  $query->orderBy('id', 'desc')->get();

        $response = [
            'time_tables' => $time_tables
        ];

        return response($response, 200);
    }

    public function delete_time_table(TimeTable $time_table)
    {
        $time_table->delete();
        $response = [
            'success' => 'Time Table has been Deleted'
        ];

        return response($response, 200);
    }
}
