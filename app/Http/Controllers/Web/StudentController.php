<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AssessmentStudent;
use App\Models\Institution;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use  App\Models\Level;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function add_students()
    {
        return view(env('APP_THEME').'.admin.pages.add-students');
    }

    public function students()
    {
        return view(env('APP_THEME'). '.admin.pages.students');
    }

    public function get_students(Institution $institution)
    {
        $students = Student::where('institution_id', $institution->id)
                    ->where('type', 0)
                    ->orderBy('id', 'desc')
                    ->paginate(30);

        $response = [
            'students' => $students
        ];

        return response($response, 200);
    }

    public function save_student(Request $request, Institution $institution)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'state' => 'required',
            'country' => 'required',
            'city' => 'required',
            'present_address' => 'required',
            'avatar' => 'required',
        ]);


        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422); //return error validator error
        }


        $user = new User;
        $user->name = $request->get('first_name') . ' ' . $request->get('last_name');
        if(!$request->get('email')) {
            $user->email = $request->get('first_name') . ' ' . $request->get('last_name').'@gmail.com';
        }else {
            $user->email = $request->get('email');
        }
        $user->email_verified_at = now();
        $user->password = Hash::make('password');
        $user->phone = $request->get('phone');
        $user->role = 2; //role is student
        $user->otp = mt_rand('1000', '9999');
        $user->save();

        $student =  new Student;
        $student->first_name = $request->get('first_name');
        $student->last_name = $request->get('last_name');
        $student->middle_name = $request->get('middle_name');
        $student->user_id = $user->id;
        $student->gender = $request->get('gender');
        $student->date_of_birth = $request->get('date_of_birth');
        $student->country_id = $request->get('country');
        $student->state_id = $request->get('state');
        $student->religion = $request->get('religion');
        $student->present_address = $request->get('present_address');
        $student->city = $request->get('city');
        $student->institution_id = $institution->id;
        if ($request->hasFile('avatar')) {
            $logo = $request->file('avatar');
            $extension = $logo->getClientOriginalExtension(); // you can also use file name
            $image =   Auth::user()->id . '-1-' . time() . '.' . $extension;
            $path = Env('PUBLIC_IMAGE_PATH');
            $upload = $logo->move($path, $image);

            $student->image = $image;
        }
        $student->save();

        $admission_number = Student::findOrFail($student->id);
        $admission_number->admission_number = $institution->prefix_code.'/'.$student->id.'/'  . mt_rand(00000, 99999);
        $admission_number->save();

        $user_number = User::findOrFail($user->id);
        $user_number->school_identification_number =  $admission_number->admission_number;
        $user_number->save();


        $response = [
            'success' => 'Student has been Added Successfully'
        ];

        return response($response, 200);

    }

    public function get_searched_students($q, Institution $institution)
    {
        $students = Student::where('institution_id', $institution->id)
                    ->where('type', 0)
                    ->where('first_name', 'LIKE', "%{$q}%")
                    ->orWhere('last_name', 'LIKE', "%{$q}%")
                    ->paginate(30);

        $response = [
            'students' => $students
        ];

        return response($response, 200);
    }

    public function get_single_student(Student $student, Institution $institution)
    {
        $classes =  Level::where('institution_id', $institution->id)->get();
        $response = [
            'student' => $student,
            'classes' => $classes
        ];

        return response($response, 200);
    }

    public function assign_class_to_student(Request $request, Student $student)
    {
        $student->level_id = $request->get('level');
        $student->save();

        $response = [
            'success' => 'Student has been assigned to the class'
        ];

        return response($response, 200);
    }

    public function student_details(Student $student)
    {
        return view(env('APP_THEME').'.admin.pages.student-details', [
            'id' => $student->id
        ]);
    }

    public function get_single_student_by_id(Student $student)
    {
        $assessments = AssessmentStudent::where('student_id', $student->id)->paginate(30);

        $response = [
            'student' => $student,
            'assessments' => $assessments
        ];

        return response($response, 200);
    }

    public function update_student(Request $request, Student $student)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'present_address' => 'required',
            'date_of_birth' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg|max:2048|nullable'
        ]);


        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422); //return error validator error
        }

        $student->first_name = $request->get('first_name');
        $student->middle_name = $request->get('middle_name');
        $student->last_name = $request->get('last_name');
        $student->present_address = $request->get('present_address');
        $student->date_of_birth = $request->get('date_of_birth');
        if ($request->hasFile('avatar')) {
            $logo = $request->file('avatar');
            $extension = $logo->getClientOriginalExtension(); // you can also use file name
            $image =   Auth::user()->id . '-1-' . time() . '.' . $extension;
            $path = Env('PUBLIC_IMAGE_PATH');
            $upload = $logo->move($path, $image);

            $student->image = $image;
        }
        $student->save();

        $user = User::findOrFail($student->user->id);
        $user->name = $request->get('first_name') . ' ' . $request->get('last_name');
        if($request->get('password')) {
            $validator = Validator::make($request->all(), [
                'password' => 'required|confirmed',
            ]);


            if ($validator->fails()) {
                return response(['errors' => $validator->errors()->all()], 422); //return error validator error
            }

            $user->password = Hash::make($request->get('password'));
        }
        $user->save();

        $response = [
            'success' => 'Updates has been saved'
        ];

        return response($response, 200);
    }

    public function make_alumni(Student $student)
    {
        $student->type = 0;
        $student->save();

        $response = [
            'success' => 'Student has been Marked as an Alumni'
        ];

        return response($response, 200);
    }
}
