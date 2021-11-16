<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Illuminate\Http\Request;

class TeacherAssignmentSubmissionController extends Controller
{
    public function submission_view(Assignment $assignment)
    {
        return view(env('APP_THEME').'.teacher.pages.submission', [
            'id' => $assignment->id
        ]);
    }
}
