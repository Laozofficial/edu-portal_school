<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\TeacherNotificationMail;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function save_teacher(Request $request, Institution $institution)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required',
            'institution_id' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'qualification' => 'required',
            'religion' => 'required',
            'email' => 'required|unique:users|email',
            'phone' => 'required|min:11',
            'present_address' => 'required',
        ]);


        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422); //return error validator error
        }

        $user =  new User;
        $user->name = $request->get('first_name').' '.$request->get('last_name');
        $user->email = $request->get('email');
        $user->email_verified_at = now();
        $user->password = Hash::make('password');
        $user->phone = $request->get('phone');
        $user->role = 1; //role is teacher
        $user->otp = mt_rand('1000', '9999');
        $user->save();

        $institution = Institution::where('id', $request->get('institution_id'))->first();

        $teacher = new Teacher;
        $teacher->user_id = $user->id;
        $teacher->institution_id = $request->get('institution_id');
        $teacher->first_name = $request->get('first_name');
        $teacher->last_name = $request->get('last_name');
        $teacher->gender = $request->get('gender');
        $teacher->date_of_birth = $request->get('date_of_birth');
        $teacher->qualification = $request->get('qualification');
        $teacher->religion = $request->get('religion');
        $teacher->present_address = $request->get('present_address');
        $teacher->state_id = $request->get('state_id');
        $teacher->country_id = $request->get('country_id');
        if ($request->hasFile('image')) {
            $logo = $request->file('image');
            $extension = $logo->getClientOriginalExtension(); // you can also use file name
            $image =   Auth::user()->id . '-1-' . time() . '.' . $extension;
            $path = Env('PUBLIC_IMAGE_PATH');
            $upload = $logo->move($path, $image);

            $teacher->image = $image;
        }
        $teacher->save();


        $details = [
            'institution_name' => $institution->name,
            'teacher' => $user->name,
            'email' => $user->email,
            'school_email' => $institution->email
        ];

        Mail::to($request->get('email'))->send(new TeacherNotificationMail($details));



        $response = [
            'success' => 'Teacher has been added to the System Successfully'
        ];

        return response($response, 200);

    }

    public function all_teachers(Institution $institution)
    {
        $teachers = Teacher::where('institution_id', $institution->id)->orderBy('id', 'desc')->paginate(25);
        $response = [
            'teachers' => $teachers
        ];
        return response($response, 200);
    }
}
