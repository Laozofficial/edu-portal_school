<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Illuminate\Http\Request;

class StudentAssignmentAnswerController extends Controller
{
    public function submit_answers(Assignment $assignment)
    {
        return view(env('APP_THEME').'.student.pages.submit-answers',[
            'assignment' => $assignment
        ]);
    }
}
