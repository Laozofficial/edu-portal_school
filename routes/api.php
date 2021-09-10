<?php

use App\Http\Controllers\Web\AcademicSessionController;
use App\Http\Controllers\Web\AcademicTermController;
use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\OTPController;
use App\Http\Controllers\Web\Auth\RegisterController;
use App\Http\Controllers\Web\GeneralInfoController;
use App\Http\Controllers\Web\InstitutionController;
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

    Route::prefix('admin')->group(function () {
            //unauthenticated admin routes
            Route::get('get_details_for_registration', [GeneralInfoController::class, 'get_details_for_registration']);
            // validate if user has atleast one school

            // authenticated route
            Route::middleware(['auth:api'])->group(function () {

                Route::post('save_institution', [InstitutionController::class, 'save_institution']);
                Route::get('validate_user_school', [InstitutionController::class, 'validate_user_school']);
                Route::get('get_all_schools', [InstitutionController::class, 'get_all_schools']);
                Route::get('get_school_details/{institution}', [InstitutionController::class, 'get_school_details']);
                Route::post('update_institution/{institution}', [InstitutionController::class, 'update_school_details']);

                // Academic session Routes
                Route::get('get_session/{institution}', [AcademicSessionController::class, 'get_sessions']);
                Route::post('save_session/{institution}', [AcademicSessionController::class, 'save_session']);
                Route::get('get_single_session/{session}', [AcademicSessionController::class, 'get_single_session']);
                Route::post('save_update_session/{session}', [AcademicSessionController::class, 'save_update_session']);

                // Term Routes
                Route::post('save_terms', [AcademicTermController::class, 'save_term']);
                Route::get('get_all_terms/{institution}', [AcademicTermController::class, 'get_terms']);

            });
    });


});
