<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class TeacherLoginController extends Controller
{
    public function login_view()
    {
        return view(env('APP_THEME').'.Teacher.pages.auth.login');
    }

    public function login_teacher(Request $request)
    {

        $validator = Validator::make($request->all(), [
            's_id' => 'required|max:255',
            'password' => 'required',
        ]); //validate request

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422); //return error validator error
        }

        $user = array('school_identification_number' => $request->get('s_id'), 'password' => $request->get('password'));

        if (!Auth::attempt($user)) {
            $errors = [
                'errors' => ['invalid login credentials']
            ];
            return response($errors, 400);
        }


        $user_token = User::where('email', $request->get('email'))->first();

        $access_token = $user_token->createToken('Easy School Auth token')->accessToken;

        $check_school = Institution::where('user_id', $user_token->id)->first();

        if ($check_school) {
            $response = [
                'user' => User::where('email', $request->get('email'))->first(),
                'token' => $access_token,
                'success' => 'Login Attempt Successful',
                'has_school' => 1
            ];

            return response($response, 200);
        } else {
            $response = [
                'user' => User::where('email', $request->get('email'))->first(),
                'token' => $access_token,
                'success' => 'Login Attempt Successful',
                'has_school' => 0
            ];

            return response($response, 200);
        }
    }
}
