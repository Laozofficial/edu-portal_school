<?php

use App\Http\Controllers\Student\StudentAssessmentController;
use App\Http\Controllers\Student\StudentTimeTableController;
use App\Http\Controllers\Student\StudentHomeWorkController;
use App\Http\Controllers\Student\StudentViewController;
use App\Http\Controllers\Teacher\Auth\TeacherLoginController;
use App\Http\Controllers\Teacher\TeacherAssignmentController;
use App\Http\Controllers\Teacher\TeacherAssignmentSubmissionController;
use App\Http\Controllers\Teacher\TeacherAttendanceController;
use App\Http\Controllers\Teacher\TeacherGradeScaleController;
use App\Http\Controllers\Teacher\TeacherLeaveController;
use App\Http\Controllers\Teacher\TeacherStudentController;
use App\Http\Controllers\Teacher\TeacherStudyMaterialController;
use App\Http\Controllers\Teacher\TeacherTimeTableController;
use App\Http\Controllers\Teacher\TeacherViewController;
use App\Http\Controllers\Web\AlumniController;
use App\Http\Controllers\Web\AssessmentTypeController;
use App\Http\Controllers\Web\GradeScaleController;
use App\Http\Controllers\Web\SubjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\OTPController;
use App\Http\Controllers\Web\Auth\RegisterController;
use App\Http\Controllers\Web\DownloadController;
use App\Http\Controllers\Web\ParentController;
use App\Http\Controllers\Web\StaffLeaveController;
use App\Http\Controllers\Web\StudentController;
use App\Http\Controllers\Web\StudyMaterialController;
use App\Http\Controllers\Web\TimeTableController;
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

Route::get('/download/countries', [DownloadController::class, 'download_countries']);
Route::get('/download/states', [DownloadController::class, 'download_states']);


Route::prefix('dashboard')->group(function () {


    Route::prefix('auth')->group(function () {

        Route::get('login', [LoginController::class, 'login_view']);
        Route::get('register', [RegisterController::class, 'register_view']);
        Route::get('otp-verification/{email}', [OTPController::class, 'otp_verification_view']);

    });


    Route::prefix('admin')->group(function () {

        Route::get('index', [ViewController::class, 'index_view']);

        // school CRUD Route
        Route::get('add-school', [ViewController::class, 'add_school_view']);
        Route::get('all-schools', [ViewController::class, 'all_schools_view']);
        Route::get('school-details/{institution:slug}', [ViewController::class, 'school_details_views']);
        Route::get('school-update/{institution:slug}', [ViewController::class, 'school_update_view']);

        // academic CRUD Route
        Route::get('academic-session', [ViewController::class, 'academic_session_view']);

        // terms route
        Route::get('term', [ViewController::class, 'terms_view']);

        // Class route
        Route::get('classes', [ViewController::class, 'classes_view']);
        Route::get('see-class-students/{level}', [ViewController::class, 'see_class_students']);

        // Teachers route
        Route::get('add-teacher', [ViewController::class, 'add_teacher']);
        Route::get('teachers', [ViewController::class, 'all_teachers_view']);
        Route::get('update-teacher/{teacher:slug}', [ViewController::class, 'teacher_update']);

        // subject Route
        Route::get('subjects', [SubjectController::class, 'subject_view']);

        // Grade Scale
        Route::get('grade-scale', [GradeScaleController::class, 'grade_scale_view']);

        // Assessment Types
        Route::get('assessment-types', [AssessmentTypeController::class, 'assessment_types']);
        Route::get('add-assessment',  [AssessmentTypeController::class, 'add_assessment']);
        Route::get('single_assessment_view/{student}', [AssessmentTypeController::class, 'single_assessment_view']);

        // student Route
        Route::get('add-students', [StudentController::class, 'add_students']);
        Route::get('students', [StudentController::class, 'students']);
        Route::get('student-details/{student}', [StudentController::class, 'student_details']);

        // time table
        Route::get('time-table', [TimeTableController::class, 'time_table_view']);

        // Parents Route
        Route::get('add-parents', [ParentController::class, 'add_parents_view']);
        Route::get('parents', [ParentController::class, 'parent_view']);

        // Alumni Route
        Route::get('alumni', [AlumniController::class, 'alumni_view']);

        // staff Leave Route
        Route::get('staff-leave', [StaffLeaveController::class, 'staff_leave']);
        Route::get('leave-type', [StaffLeaveController::class, 'leave_type']);

        // study materials
        Route::get('study-materials', [StudyMaterialController::class, 'study_materials']);


    });

    Route::prefix('teacher')->group(function () {

        Route::prefix('auth')->group(function () {
            Route::get('login', [TeacherLoginController::class, 'login_view']);
            // Route::get('register', [RegisterController::class, 'register_view']);
            // Route::get('otp-verification/{email}', [OTPController::class, 'otp_verification_view']);
        });

        Route::get('index', [TeacherViewController::class, 'index']);
        Route::get('classes', [TeacherViewController::class, 'classes']);
        Route::get('add-assessment', [TeacherViewController::class, 'add_assessment']);
        Route::get('time-table', [TeacherTimeTableController::class, 'time_table']);
        Route::get('assignment', [TeacherAssignmentController::class, 'assignment_view']);
        Route::get('students', [TeacherStudentController::class, 'students']);
        Route::get('student-attendance', [TeacherAttendanceController::class, 'student_attendance']);
        Route::get('student-record/{student}', [TeacherStudentController::class, 'student_record_view']);
        Route::get('grade-scale', [TeacherGradeScaleController::class, 'grade_scale_view']);
        Route::get('study-materials', [TeacherStudyMaterialController::class, 'study_material_view']);
        Route::get('submissions/{assignment}', [TeacherAssignmentSubmissionController::class, 'submission_view' ]);
        Route::get('staff-leave', [TeacherLeaveController::class, 'staff_leave_view']);

    });

    Route::prefix('student')->group(function () {
        Route::prefix('auth')->group(function() {
            Route::get('login', [StudentViewController::class, 'login_view']);
        });

        Route::get('index', [StudentViewController::class, 'index']);
        Route::get('student_assessments', [StudentAssessmentController::class, 'student_assessments']);
        Route::get('time-table', [StudentTimeTableController::class, 'time_table']);
        Route::get('home-work', [StudentHomeWorkController::class, 'home_work']);

    });





});
