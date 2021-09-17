<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function subject_view()
    {
        return view('admin.pages.subjects');
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
        $subject->save();

        $response = [
            'success' => 'Subject has been updated successfully'
        ];

        return response($response, 200);
    }

}
