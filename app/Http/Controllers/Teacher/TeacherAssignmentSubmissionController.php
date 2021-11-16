<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentAnswer;
use Illuminate\Http\Request;

class TeacherAssignmentSubmissionController extends Controller
{
    public function submission_view(Assignment $assignment)
    {
        return view(env('APP_THEME').'.teacher.pages.submission', [
            'id' => $assignment->id
        ]);
    }

    public function get_assignment_submission(Assignment $assignment)
    {
        $submissions = AssignmentAnswer::where('assignment_id', $assignment->id)->paginated(10);
        $response = [
            'submissions' => $submissions
        ];

        return response($response, 200);
    }
}
