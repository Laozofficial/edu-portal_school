<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Mail;

class OTPController extends Controller
{
    public function otp_verification_view($email)
    {
        return view('admin.pages.auth.otp-verification', [
            'email' => $email
        ]);
    }

    public function resend_otp_code(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
        ]); //validate request

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422); //return error validator error
        }

        $email_otp = rand(10000, 99999); //otp generation

        $this->generate_OTP($request->get('email'), $email_otp);

        $response = [
            'success' => 'OTP has been resent'
        ];

        return response($response, 200);
    }

    // otp generation method
    public function generate_OTP($email, $email_otp)
    {
        $data = array(
            'otp' =>  $email_otp
        );


        Mail::send('email.otp', $data, function ($message) use ($email) {
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
