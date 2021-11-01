<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Term;
use Illuminate\Http\Request;

class TeacherTermsController extends Controller
{
    public function teacher_get_terms(AcademicYear $session)
    {
        $terms = Term::where('academic_year_id', $session->id)->orderBy('id', 'desc')->get();
        $response = [
            'terms' => $terms
        ];

        return response($response, 200);
    }
}
