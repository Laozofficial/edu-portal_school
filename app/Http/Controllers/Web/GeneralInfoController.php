<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Institution;
use App\Models\InstitutionAttendance;
use App\Models\Language;
use App\Models\State;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Term;
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

    public function save_attendance_setup(Request $request)
    {
        $setup = InstitutionAttendance::where([
                    'institution_id' => $request->get('institution'),
                    'term_id' => $request->get('term'),
                    'academic_year_id' => $request->get('session')
                    ])->first();

        if ($setup) {
            $response = [
                'error' => 'Attendance setup already exists.'
            ];

            return response($response, 400);
        }



        $attendance_setup = new InstitutionAttendance;
        $attendance_setup->institution_id = $request->get('institution');
        $attendance_setup->academic_year_id = $request->get('session');
        $attendance_setup->term_id = $request->get('term');
        $attendance_setup->total_days = $request->get('total_days');
        $attendance_setup->save();

        $response = [
            'success' => 'Attendance setup saved successfully.'
        ];

        return response($response, 200);

    }

    public function get_terms_by_session(AcademicYear $session)
    {
        $terms = Term::where(['academic_year_id' => $session->id])->orderByDesc('id')->get();

        $response = [
            'terms' => $terms
        ];

        return response($response, 200);
    }

    public function get_attendance_setups(Institution $institution)
    {
        $attendance_setups = InstitutionAttendance::where(['institution_id' => $institution->id])->get();

        $response = [
            'attendance_setups' => $attendance_setups
        ];

        return response($response, 200);
    }

    public function update_attendance_setup(Request $request, InstitutionAttendance $attendance_setup)
    {
        $attendance_setup->total_days = $request->get('total_days');
        $attendance_setup->save();

        $response = [
            'success' => 'Attendance setup updated successfully.'
        ];

        return response($response, 200);
    }
}
