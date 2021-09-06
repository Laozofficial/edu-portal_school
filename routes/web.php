<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\OTPController;
use App\Http\Controllers\Web\Auth\RegisterController;
use App\Http\Controllers\Web\ViewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('dashboard')->group(function () {


    Route::prefix('auth')->group(function () {

        Route::get('login', [LoginController::class, 'login_view']);
        Route::get('register', [RegisterController::class, 'register_view']);
        Route::get('otp-verification/{email}', [OTPController::class, 'otp_verification_view']);

    });


     Route::prefix('admin')->group(function () {

        Route::get('index', [ViewController::class, 'index_view']);
        Route::get('add-school', [ViewController::class, 'add_school_view']);

    });





});
