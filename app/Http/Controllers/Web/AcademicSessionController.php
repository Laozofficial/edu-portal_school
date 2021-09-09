<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Institution;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AcademicSessionController extends Controller
{
    public function get_sessions(Institution $institution)
    {
        $sessions = AcademicYear::where('institution_id', $institution->id)->orderBy('id', 'desc')->get();
        $response = [
            'sessions' => $sessions
        ];
        return response($response, 200);
    }


    public function save_session(Request $request,  Institution $institution)
    {
        $session = new AcademicYear;
        $session->start_date = Carbon::createFromFormat('Y-m-d', $request->get('start_date'))->toDateTimeString();
        $session->end_date = Carbon::createFromFormat('Y-m-d', $request->get('end_date'))->toDateTimeString();
        $session->save();
    }
}
