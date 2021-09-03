<?php

use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\OTPController;
use App\Http\Controllers\Web\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('dashboard')->group(function () {


    Route::prefix('auth')->group(function () {
        Route::post('login', [LoginController::class, 'login_user']);
        Route::post('register', [RegisterController::class, 'register_user']);
        Route::post('resend_otp', [OTPController::class, 'resend_otp_code']);
        Route::post('verify-otp', [OTPController::class, 'verify_otp']);
    });


});
