<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Assignment;
use App\Models\Level;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherAssignmentController extends Controller
{
    public function assignment_view()
    {
        return view(env('APP_THEME').'.teacher.pages.assignment');
    }

    public function get_teacher_classes()
    {
        $teacher  = Teacher::where('user_id', Auth::user()->id)->first();
        $levels = Level::where('teacher_id', $teacher->id)->get();
        $sessions = AcademicYear::where('institution_id', $teacher->institution_id)->get();

        $response = [
            'levels' => $levels,
            'sessions' => $sessions
        ];

        return response($response, 200);
    }

    public function get_assignments()
    {
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();

        $assignments = Assignment::where('teacher_id', $teacher->id)->orderBy('id', 'desc')->paginate(10);

        $response = [
            'assignments' => $assignments
        ];

        return response($response, 200);
    }

    public function save_assignment(Request $request)
    {
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();

        $assignment = new Assignment;
        $assignment->institution_id = $teacher->institution_id;
        $assignment->teacher_id = $teacher->id;
        $assignment->academic_year_id = $request->get('session_id');
        $assignment->level_id = $request->get('level_id');
        $assignment->subject_id = $request->get('subject_id');
        $assignment->term_id = $request->get('term_id');
        $assignment->submission_date = Carbon::parse($request->get('submission_date'));
        if ($request->hasFile('assignment')) {
            $tt = $request->file('assignment');
            $extension = $tt->getClientOriginalExtension(); // you can also use file name
            $the_file =   Auth::user()->id . $request->get('session') . time() . '.' . $extension;
            $path = Env('PUBLIC_IMAGE_PATH');
            $upload = $tt->move($path, $the_file);

            $assignment->path = $the_file;
        }
        $assignment->save();

        $response = [
            'success' => 'Assignment has been Uploaded Successfully'
        ];

        return response($response, 200);
    }
}
