<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Institution;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AcademicSessionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }


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
        $start_date = Carbon::parse($request->get('start_date'));
        $end_date = Carbon::parse($request->get('end_date'));

        if($end_date->lt($start_date))  {
            $response = [
                'error' => 'End Date cannot be less than the start date'
            ];

            return response($response, 422);
        }else {
            $session = new AcademicYear;
            $session->institution_id =  $institution->id;
            $session->name = $request->get('name');
            $session->start_date = Carbon::createFromFormat('Y-m-d', $request->get('start_date'))->toDateTimeString();
            $session->end_date = Carbon::createFromFormat('Y-m-d', $request->get('end_date'))->toDateTimeString();
            $session->status = $request->get('status');
            $session->save();

            $response = [
                'success' => 'session has been created'
            ];

            return response($response, 200);
        }
    }

    public function get_single_session(AcademicYear $session)
    {
        $response = [
            'session' => $session
        ];

        return response($response, 200);
    }

    public function save_update_session(Request $request, AcademicYear $session)
    {
        $start_date = Carbon::parse($request->get('start_date'));
        $end_date = Carbon::parse($request->get('end_date'));

        if ($end_date->lt($start_date)) {
            $response = [
                'error' => 'End Date cannot be less than the start date'
            ];

            return response($response, 422);
        } else {
            $session->name = $request->get('name');
            $session->start_date = Carbon::createFromFormat('Y-m-d', $request->get('start_date'))->toDateTimeString();
            $session->end_date = Carbon::createFromFormat('Y-m-d', $request->get('end_date'))->toDateTimeString();
            $session->status = $request->get('status');
            $session->save();

            $response = [
                'success' => 'session has been updated'
            ];

            return response($response, 200);
        }
    }

}
