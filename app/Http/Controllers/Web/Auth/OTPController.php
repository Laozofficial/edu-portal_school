<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;

class OTPController extends Controller
{
    public function otp_verification_view($email)
    {
        return view(env('APP_THEME').'admin.pages.auth.otp-verification', [
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

        $user = User::where('email', $request->get('email'))->first();
        $user->otp = $email_otp;
        $user->save();

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

    public function verify_otp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'otp' => 'required',
        ]); //validate request

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422); //return error validator error
        }

        $user = User::where('email', $request->get('email'))
        ->where('otp', $request->get('otp'))
        ->first();

        if ($user) {
            if ($user->email_verified_at) {
                $response = [
                    'errors' => 'this account has already been verified'
                ];

                return response($response, 400);
            } else {
                $user->email_verified_at = now();
                $user->save();

                $response = [
                    'success' => 'Account has been verified'
                ];

                return response($response, 200);
            }
        } else {
            $response = [
                'errors' => 'OTP does not match the email'
            ];

            return response($response, 400);
        }
    }

}
