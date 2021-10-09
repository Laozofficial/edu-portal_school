<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function subject_view()
    {
        return view(env('APP_THEME') . '.admin.pages.subjects');
    }

    public function get_subjects(Institution $institution)
    {
        $subjects = Subject::where('institution_id', $institution->id)->orderBy('id', 'desc')->paginate(30);
        $response = [
            'subjects' => $subjects
        ];

        return response($response, 200);
    }

    public function save_subject(Request $request, Institution $institution)
    {
        $subjects = new Subject;
        $subjects->name = $request->get('name');
        $subjects->subject_code = $request->get('subject_code');
        $subjects->institution_id =  $institution->id;
        $subjects->label = $request->get('label');
        $subjects->level_id = $request->get('level');
        $subjects->save();

        $response = [
            'success' => 'Subject has been added successfully'
        ];

        return response($response, 200);
    }

    public function get_single_subject(Subject $subject)
    {
        $response = [
            'subject' => $subject
        ];

        return response($response, 200);
    }

    public function save_subject_update(Request $request, Subject $subject)
    {
        $subject->name = $request->get('name');
        $subject->subject_code = $request->get('subject_code');
        $subject->label = $request->get('label');
        if($request->get('level')) {
            $subject->level_id = $request->get('level');
        }
        $subject->save();

        $response = [
            'success' => 'Subject has been updated successfully'
        ];

        return response($response, 200);
    }

}
