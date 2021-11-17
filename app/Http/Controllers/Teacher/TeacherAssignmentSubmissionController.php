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
        $submissions = AssignmentAnswer::where('assignment_id', $assignment->id)->paginate(10);
        $response = [
            'submissions' => $submissions
        ];

        return response($response, 200);
    }

    public function get_single_submission(AssignmentAnswer $submission)
    {
        $response = [
            'submission' => $submission
        ];

        return response($response, 200);
    }

    public function save_assignment_score(Request $request, AssignmentAnswer $submission)
    {
        $assignment = Assignment::where('id', $submission->assignment_id)->first();

        if($request->get('score') > $assignment->score) {
            $response  = [
                'error' => 'Inputted Score is more than the assigned score for the assignment'
            ];

            return response($response,  200);
        }else {
            $submission->score = $request->get('score');
            $submission->save();

            $response = [
                'success' => 'Assignment has been score'
            ];

            return response($response, 200);
        }
    }
}
