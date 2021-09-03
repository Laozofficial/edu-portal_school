<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login_view()
    {
        return view('admin.pages.auth.login');
    }

    public function login_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required',
        ]); //validate request

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422); //return error validator error
        }

        $user = array('email' => $request->get('email'), 'password' => $request->get('password'));

        if (!Auth::attempt($user)) {
            $errors = [
                'errors' => ['invalid login credentials']
            ];
            return response($errors, 400);
        }

        // if (Auth::user()->status === 'banned' || Auth::user()->status === 'account deleted') {
        //     $errors = [
        //         'error' => 'Login Sequence Blocked, Please talk to our support'
        //     ];

        //     return response($errors, 400);
        // }

        $user_token = User::where('email', $request->get('email'))->first();

        $access_token = $user_token->createToken('Easy School Auth token')->accessToken;

        $response = [
            'user' => User::where('email', $request->get('email'))->first(),
            'token' => $access_token,
            'success' => 'Login Attempt Successful'
        ];

        return response($response, 200);
    }
}
