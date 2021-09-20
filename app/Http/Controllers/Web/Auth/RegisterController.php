<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Mail;

class RegisterController extends Controller
{
    public function register_view()
    {
        return view(env('APP_THEME').'admin.pages.auth.register');
    }


    public function register_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|unique:users|email',
            'phone_number' => 'required|min:11',
            'password' => 'required|confirmed|min:8'
        ]);


        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422); //return error validator error
        }


        $email_otp = rand(10000, 99999); //otp generation

        $this->generate_OTP($request->get('email'), $email_otp);


        $user = new User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone_number');
        $user->password = Hash::make($request->get('password'));
        $user->otp = $email_otp;
        $user->save();

        $response = [
            'success' => 'An OTP has been sent to your email',
            'message' => 'You will be redirected to the page'
        ];

        return response($response, 200);
    }


    // otp generation method
    public function generate_OTP($email, $email_otp)
    {
        $data = array(
            'otp' =>  $email_otp
        );


        Mail::send('admin.pages.auth.email.otp', $data, function ($message) use ($email) {
            $message->from('noreply@easyschool.com.ng', 'Easy School OTP');
            $message->to($email);
            // $message->cc('john@johndoe.com', 'John Doe');
            // $message->bcc('john@johndoe.com', 'John Doe');
            $message->replyTo('noreply@easyschool.com.ng', 'Easy School');
            $message->subject('Hello , Here is your Easy One Time Password');
        });
        if (Mail::failures()) { //if mail sending fails
            return response()->json([
                'errors' => [
                    'errors' => 'something went wrong with the OTP Verification , please re-submit again'
                ]
            ]);
        }
    }

}
