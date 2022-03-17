<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Institution;
use App\Models\Language;
use App\Models\State;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class GeneralInfoController extends Controller
{
    public function get_details_for_registration()
    {
        $countries = Country::orderBy('id', 'desc')->get();
        $currencies = Currency::orderBy('id', 'desc')->get();
        $languages = Language::orderBy('id', 'desc')->get();
        $states = State::orderBy('id', 'asc')->get();

        $response = [
            'countries' => $countries,
            'currencies' => $currencies,
            'languages' => $languages,
            'states' => $states
        ];

        return response($response, 200);
    }

    public function dashboard_details()
    {
        $$institutions = Institution::where(['user_id' => Auth::user()->id])->first();
        $students = Student::where(['institution_id' => $institutions->id])->get();
        $teachers = Teacher::where(['institution_id' => $institutions->id])->get();
        $subjects = Subject::where(['institution_id' => $institutions->id])->get();

        $last_registered_student = Student::orderByDesc('id')->first();
        $last_registered_teacher = Teacher::orderByDesc('id')->first();

        $response = [
            'institutions' => $institutions,
            'students' => $students,
            'teachers' => $teachers,
            'subjects' => $subjects,
            'last_registered_student' => $last_registered_student,
            'last_registered_teacher' => $last_registered_teacher
        ];

        return response($response, 200);
    }
}
