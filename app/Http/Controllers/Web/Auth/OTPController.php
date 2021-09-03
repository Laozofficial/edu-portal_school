<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OTPController extends Controller
{
    public function otp_verification_view($email)
    {
        return view('admin.pages.auth.otp-verification', [
            'email' => $email
        ]);
    }

}
