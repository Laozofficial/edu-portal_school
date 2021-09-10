<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Institution;
use App\Models\Term;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AcademicTermController extends Controller
{
    public function save_term(Request $request)
    {
        $session = AcademicYear::where('id', $request->get('academic_year_id'))->first();

        $term_start_date = Carbon::parse($request->get('start_date'));
        $term_end_date = Carbon::parse($request->get('end_start'));

        $session_start_date = Carbon::parse($session->start_date);
        $session_end_date = Carbon::parse($session->end_date);

        // if ($term_end_date->lt($term_start_date)) {
        //     $response = [
        //         'error' => 'Term End Date cannot be less than the start date'
        //     ];

        //     return response($response, 422);
        // }

        if($term_start_date->lt($session_start_date)) {
            $response = [
                'error' => 'Term Date cannot be before the session date'
            ];

            return response($response, 422);
        }

        if($term_end_date->gt($session_end_date)) {
            $response = [
                'error' => 'Term End Date cannot be greater than the session date'
            ];

            return response($response, 422);
        }

        $term = new Term;
        $term->institution_id = $request->get('institution_id');
        $term->academic_year_id = $request->get('academic_year_id');
        $term->name = $request->get('name');
        $term->start_date = Carbon::createFromFormat('Y-m-d', $request->get('start_date'))->toDateTimeString();
        $term->end_date = Carbon::createFromFormat('Y-m-d', $request->get('end_date'))->toDateTimeString();
        $term->status = $request->get('status');
        $term->save();

        $response = [
            'success' => 'Term has been Added successfully'
        ];

        return response($response, 200);
    }

    public function get_terms(Institution $institution)
    {
        $terms = Term::where('institution_id', $institution->id)->get();
        $response = [
            'terms' => $terms
        ];

        return response($response, 200);
    }

    public function get_single_term(Term $term)
    {
        $response = [
            'term' => $term
        ];

        return response($response, 200);
    }

    public function save_updated_term(Request $request, Term $term)
    {
        $session = AcademicYear::where('id', $term->academic_year_id)->first();

        $term_start_date = Carbon::parse($request->get('start_date'));
        $term_end_date = Carbon::parse($request->get('end_start'));

        $session_start_date = Carbon::parse($session->start_date);
        $session_end_date = Carbon::parse($session->end_date);

        // if ($term_end_date->lt($term_start_date)) {
        //     $response = [
        //         'error' => 'Term End Date cannot be less than the start date'
        //     ];

        //     return response($response, 422);
        // }

        if($term_start_date->lt($session_start_date)) {
            $response = [
                'error' => 'Term Date cannot be before the session date'
            ];

            return response($response, 422);
        }

        if($term_end_date->gt($session_end_date)) {
            $response = [
                'error' => 'Term End Date cannot be greater than the session date'
            ];

            return response($response, 422);
        }

        $term->name = $request->get('name');
        $term->start_date = Carbon::createFromFormat('Y-m-d', $request->get('start_date'))->toDateTimeString();
        $term->end_date = Carbon::createFromFormat('Y-m-d', $request->get('end_date'))->toDateTimeString();
        $term->status = $request->get('status');
        $term->save();

        $response = [
            'success' => 'Term has been Updated successfully'
        ];

        return response($response, 200);
    }
}
