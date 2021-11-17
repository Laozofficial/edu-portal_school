<?php

use App\Http\Controllers\Teacher\Auth\TeacherLoginController;
use App\Http\Controllers\Teacher\TeacherAssessmentController;
use App\Http\Controllers\Teacher\TeacherAssignmentController;
use App\Http\Controllers\Teacher\TeacherAssignmentSubmissionController;
use App\Http\Controllers\Teacher\TeacherAttendanceController;
use App\Http\Controllers\Teacher\TeacherClassController;
use App\Http\Controllers\Teacher\TeacherGradeScaleController;
use App\Http\Controllers\Teacher\TeacherStudentController;
use App\Http\Controllers\Teacher\TeacherStudyMaterialController;
use App\Http\Controllers\Teacher\TeacherTermsController;
use App\Http\Controllers\Teacher\TeacherTimeTableController;
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
use App\Http\Controllers\Web\ParentController;
use App\Http\Controllers\Web\StudentController;
use App\Http\Controllers\Web\TeacherController;
use App\Http\Controllers\Web\TimeTableController;
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
                Route::get('ban_teacher/{user}', [TeacherController::class, 'ban_teacher']);
                Route::get('activate_teacher/{user}', [TeacherController::class, 'activate_teacher']);

                // class
                Route::post('save_class', [LevelController::class, 'save_class']);
                Route::get('get_single_class/{level}', [LevelController::class, 'get_single_class']);
                Route::post('update_single_class/{level}', [LevelController::class, 'update_single_class']);
                Route::get('get_students_for_class/{level}', [LevelController::class, 'get_students_for_class']);
                Route::get('get_all_classes/{institution}', [LevelController::class, 'get_all_classes']);
                Route::get('get_class_subjects/{level}', [LevelController::class, 'get_class_subjects']);

                // subjects
                Route::get('get_subjects/{institution}', [SubjectController::class, 'get_subjects']);
                Route::post('save_subject/{institution}', [SubjectController::class, 'save_subject']);
                Route::get('get_single_subject/{subject}', [SubjectController::class, 'get_single_subject']);
                Route::post('save_subject_update/{subject}', [SubjectController::class, 'save_subject_update']);
                Route::get('make_alumni/{student}', [StudentController::class, 'make_alumni']);

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
                Route::get('get_details_to_assessment/{institution}/{student}', [AssessmentTypeController::class, 'get_details_to_assessment']);
                Route::post('save_student_assessments', [AssessmentTypeController::class, 'save_student_assessments']);
                Route::get('get_student_assessments/{student}', [AssessmentTypeController::class, 'get_student_assessments']);
                Route::get('get_single_assessment_for_student/{assessment}', [AssessmentTypeController::class, 'get_single_assessment_for_student']);
                Route::post('update_single_assessment_score/{assessment}', [AssessmentTypeController::class, 'update_single_assessment']);

                // student Routes
                Route::get('get_students/{institution}', [StudentController::class, 'get_students']);
                Route::post('save_student/{institution}', [StudentController::class, 'save_student']);
                Route::get('search_student/{q}/{institution}', [StudentController::class, 'get_searched_students']);
                Route::get('get_single_student/{student}/{institution}', [StudentController::class, 'get_single_student']);
                Route::post('assign_class_to_student/{student}', [StudentController::class, 'assign_class_to_student']);
                Route::get('get_single-student_by_id/{student}', [StudentController::class, 'get_single_student_by_id']);
                Route::post('update_student/{student}', [StudentController::class, 'update_student']);
                Route::get('get_student_alumni/{institution}', [StudentController::class, 'get_student_alumni']);
                Route::get('remove_as_alumni/{student}', [StudentController::class, 'remove_as_alumni']);

                // time table routes
                Route::get('get_other_details/{institution}', [TimeTableController::class, 'get_other_details']);
                Route::get('get_terms_from_academic_session/{session}', [TimeTableController::class, 'get_terms_from_academic_session']);
                Route::post('save_time_table', [TimeTableController::class, 'save_time_table']);
                Route::post('get_time_tables/{institution}', [TimeTableController::class, 'get_time_tables']);
                Route::get('delete_time_table/{time_table}', [TimeTableController::class, 'delete_time_table']);

                // parent route
                Route::post('save_parent', [ParentController::class, 'save_parent']);
                Route::get('get_student_parent/{student}', [ParentController::class, 'get_student_parents']);
                Route::get('get_single_parent/{parent}', [ParentController::class, 'get_single_parent']);
                Route::post('update_single_parent/{parent}', [ParentController::class, 'update_single_parent']);
                Route::get('get_all_parents/{institution}', [ParentController::class, 'get_all_parents']);

            });
    });

    Route::prefix('teacher')->group(function () {

        Route::prefix('auth')->group(function () {
            Route::post('teacher-login', [TeacherLoginController::class, 'login_teacher']);
        });

        Route::middleware(['auth:api'])->group(function () {
            Route::get('teacher_classes', [TeacherClassController::class, 'teacher_classes']);
            Route::get('get_level_student/{level}', [TeacherClassController::class, 'get_level_students']);
            Route::get('get_student_records/{student}', [TeacherAssessmentController::class, 'get_student_records']);
            Route::get('teacher_get_terms/{session}', [TeacherTermsController::class, 'teacher_get_terms']);
            Route::get('teacher_get_subjects/{level}', [TeacherClassController::class, 'teacher_get_subjects']);
            Route::get('get_other_details', [TeacherTimeTableController::class, 'get_other_details']);
            Route::get('get_terms_from_academic_session/{session}', [TeacherTimeTableController::class, 'get_terms_from_academic_session']);
            Route::post('get_time_tables', [TeacherTimeTableController::class, 'get_time_tables']);
            Route::get('get_teacher_classes', [TeacherAssignmentController::class, 'get_teacher_classes']);
            Route::get('get_assignments', [TeacherAssignmentController::class, 'get_assignments']);
            Route::post('save_assignment', [TeacherAssignmentController::class, 'save_assignment']);
            Route::post('save_assessment', [TeacherAssessmentController::class, 'save_assessments']);
            Route::get('get_students_from_class/{level}', [TeacherStudentController::class, 'get_students_from_class']);
            Route::post('save_attendance/{student}', [TeacherAttendanceController::class, 'save_attendance']);
            Route::get('get_student_info/{student}', [TeacherStudentController::class, 'get_student_info']);
            Route::get('get_student_parents/{student}', [TeacherStudentController::class, 'get_student_parents']);
            Route::get('get_assessment_records/{student}', [TeacherAssessmentController::class, 'get_assessment_records']);
            Route::get('get_grade_scale', [TeacherGradeScaleController::class, 'get_grade_scale']);
            Route::get('get_teacher_materials', [TeacherStudyMaterialController::class, 'get_materials']);
            Route::post('save_material', [TeacherStudyMaterialController::class, 'save_material']);
            Route::get('delete_material/{material}', [TeacherStudyMaterialController::class, 'delete_material']);
            Route::get('get_assignment_submission/{assignment}', [TeacherAssignmentSubmissionController::class, 'get_assignment_submission']);
            Route::get('get_single_submission/{submission}', [TeacherAssignmentSubmissionController::class, 'get_single_submission']);
            Route::post('save_assignment_score/{submission}', [TeacherAssignmentSubmissionController::class, 'save_assignment_score']);
        });
    });
});
