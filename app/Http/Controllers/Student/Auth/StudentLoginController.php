<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class StudentLoginController extends Controller
{
    public function student_login(Request $request)
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

        if (Auth::user()->status == 1) {
            $response = [
                'errors' => ['Your Account has been banned and you no longer have access to this system']
            ];

            return response($response, 400);
        }

        if (Auth::user()->role != 2) {
            $response = [
                'errors' => ['You are not a Registered Student on this system']
            ];

            return response($response, 400);
        }

        $user_token = User::where('school_identification_number', $request->get('s_id'))->first();

        $access_token = $user_token->createToken('Easy School Auth token')->accessToken;

        $response = [
            'user' => $user_token,
            'token' => $access_token,
            'success' => 'Login Attempt Successful',
        ];

        return response($response, 200);

    }
}
