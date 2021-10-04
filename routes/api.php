<?php

use App\Http\Controllers\Web\GradeScaleController;
use App\Http\Controllers\Web\LevelController;
use App\Http\Controllers\Web\SubjectController;
use App\Http\Controllers\Web\AcademicSessionController;
use App\Http\Controllers\Web\AcademicTermController;
use App\Http\Controllers\Web\AssessmentTypeController;
use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\OTPController;
use App\Http\Controllers\Web\Auth\RegisterController;
use App\Http\Controllers\Web\GeneralInfoController;
use App\Http\Controllers\Web\InstitutionController;
use App\Http\Controllers\Web\StudentController;
use App\Http\Controllers\Web\TeacherController;
use App\Models\GradeScale;
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

                // get teachers and classes
                Route::get('get_classes_and_teachers/{institution}', [InstitutionController::class, 'get_classes_and_teachers']);

                // Academic session Routes
                Route::get('get_session/{institution}', [AcademicSessionController::class, 'get_sessions']);
                Route::post('save_session/{institution}', [AcademicSessionController::class, 'save_session']);
                Route::get('get_single_session/{session}', [AcademicSessionController::class, 'get_single_session']);
                Route::post('save_update_session/{session}', [AcademicSessionController::class, 'save_update_session']);

                // Term Routes
                Route::post('save_terms', [AcademicTermController::class, 'save_term']);
                Route::get('get_all_terms/{institution}', [AcademicTermController::class, 'get_terms']);
                Route::get('get_single_term/{term}', [AcademicTermController::class, 'get_single_term']);
                Route::post('save_updated_term/{term}', [AcademicTermController::class, 'save_updated_term']);

                // Teacher Route
                Route::post('save_teacher/{institution}', [TeacherController::class, 'save_teacher']);
                Route::get('get_teachers/{institution}', [TeacherController::class, 'all_teachers']);
                Route::get('get_single_teacher/{teacher:slug}', [TeacherController::class, 'get_single_teacher']);
                Route::post('update_single_teacher/{teacher:slug}', [TeacherController::class, 'update_single_teacher']);
                Route::post('update_teacher_passport/{teacher:slug}', [TeacherController::class, 'update_teacher_passport']);

                // class
                Route::post('save_class', [LevelController::class, 'save_class']);
                Route::get('get_single_class/{level}', [LevelController::class, 'get_single_class']);
                Route::post('update_single_class/{level}', [LevelController::class, 'update_single_class']);

                // subjects
                Route::get('get_subjects/{institution}', [SubjectController::class, 'get_subjects']);
                Route::post('save_subject/{institution}', [SubjectController::class, 'save_subject']);
                Route::get('get_single_subject/{subject}', [SubjectController::class, 'get_single_subject']);
                Route::post('save_subject_update/{subject}', [SubjectController::class, 'save_subject_update']);

                // grades
                Route::post('save_grades/{institution}', [GradeScaleController::class, 'save_grade']);
                Route::get('get_grades/{institution}', [GradeScaleController::class, 'get_grades']);
                Route::get('get_single_grade/{grade}', [GradeScaleController::class, 'get_single_grade']);
                Route::post('save_grade_update/{grade}', [GradeScaleController::class, 'save_update_grade']);
                Route::get('delete_grade/{grade}', [GradeScaleController::class, 'delete_grade']);

                // Assessment Type
                Route::get('get_assessment_types/{institution}', [AssessmentTypeController::class, 'get_assessment_type']);
                Route::get('get_single_assessment/{assessment_type}', [AssessmentTypeController::class, 'get_single_assessment']);
                Route::post('save_assessment_type/{institution}', [AssessmentTypeController::class, 'save_assessment']);
                Route::post('update_single_assessment/{assessment_type}', [AssessmentTypeController::class, 'save_update_assessment']);


                // student Routes
                Route::get('get_students/{institution}', [StudentController::class, 'get_students']);
                Route::post('save_student/{institution}', [StudentController::class, 'save_student']);
                Route::get('search_student/{q}/{institution}', [StudentController::class, 'get_searched_students']);
                Route::get('get_single_student/{student}/{institution}', [StudentController::class, 'get_single_student']);
                Route::post('assign_class_to_student/{student}', [StudentController::class, 'assign_class_to_student']);

            });
    });
});
