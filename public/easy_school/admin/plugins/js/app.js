let url = {
    register: 'auth/register',
    resend_otp: 'auth/resend_otp',
    verify_otp: 'auth/verify-otp',
    login: 'auth/login',

    // check if user has a school
    validate_user_school: 'validate_user_school',

    // check items
    get_classes_and_teachers: 'get_classes_and_teachers/',

    // get terms with session
    get_terms_by_session: 'get_terms_by_session/',

    // get attendance setups
    get_attendance_setups: 'get_attendance_setups/',
    update_attendance_setup: 'update_attendance_setup/',


    // institution attendance setup
    save_attendance_setup: 'save_attendance_setup',

    // school admin
    get_details_for_registration: 'get_details_for_registration',
    save_institution: 'save_institution',
    update_institution: 'update_institution/',
    get_all_schools: 'get_all_schools',
    get_school_details: 'get_school_details/',

    // session level routes links
    get_session: 'get_session/',
    save_session: 'save_session/',
    get_single_session: 'get_single_session/',
    save_update_session: 'save_update_session/',

    // terms
    save_terms: 'save_terms',
    get_terms: 'get_all_terms/',
    get_single_term: 'get_single_term/',
    save_updated_term: 'save_updated_term/',

    // teacher
    save_teacher: 'save_teacher/',
    get_teachers: 'get_teachers/',
    get_single_teacher: 'get_single_teacher/',
    update_teacher: 'update_single_teacher/',
    update_teacher_passport: 'update_teacher_passport/',
    ban_teacher: 'ban_teacher/',
    activate_teacher: 'activate_teacher/',

    // classes
    save_class: 'save_class',
    get_single_class: 'get_single_class/',
    update_single_class: 'update_single_class/',
    get_students_for_class: 'get_students_for_class/',
    get_classes: 'get_all_classes/',
    get_subjects_in_class: 'get_class_subjects/',

    // subjects
    get_subjects: 'get_subjects/',
    save_subject: 'save_subject/',
    get_single_subject: 'get_single_subject/',
    save_subject_update: 'save_subject_update/',

    // grades
    save_grades: 'save_grades/',
    get_grades: 'get_grades/',
    get_single_grade: 'get_single_grade/',
    save_grade_update: 'save_grade_update/',
    delete_grade: 'delete_grade/',

    // Assessment Types
    get_assessment_types: 'get_assessment_types/',
    get_single_assessment: 'get_single_assessment/',
    save_assessment_type: 'save_assessment_type/',
    update_single_assessment_type: 'update_single_assessment/',
    get_details_to_assessment: 'get_details_to_assessment/',
    save_student_assessment: 'save_student_assessments',
    get_student_assessments: 'get_student_assessments/',
    get_single_assessment_for_student: 'get_single_assessment_for_student/',
    update_single_assessment: 'update_single_assessment_score/',

    // students Routes
    get_students: 'get_students/',
    save_student: 'save_student/',
    search_student: 'search_student/',
    get_single_student: 'get_single_student/',
    assign_class: 'assign_class_to_student/',
    get_single_student_by_id: 'get_single-student_by_id/',
    update_student: 'update_student/',
    make_alumni: 'make_alumni/',
    get_student_alumni: 'get_student_alumni/',
    remove_as_alumni: 'remove_as_alumni/',

    // time table routes
    get_other_details: 'get_other_details/',
    get_terms_from_academic_session: 'get_terms_from_academic_session/',
    save_time_table: 'save_time_table',
    get_time_tables: 'get_time_tables/',
    delete_time_table: 'delete_time_table/',

    // save parent
    save_parent: 'save_parent',
    get_parents: 'get_student_parent/',
    get_single_parent: 'get_single_parent/',
    update_single_parent: 'update_single_parent/',
    get_all_parents: 'get_all_parents/',

    //teacher auth
    teacher_login: 'teacher-login',
    teacher_classes: 'teacher_classes',

    // leave Routes
    teacher_leave_applications: 'teacher_leaves_applications/',
    get_leave_details: 'get_leave_details/',
    save_leave_response: 'save_leave_response/',

    // leave types
    get_leave_types: 'get_leave_types/',
    save_leave_type_update: 'save_leave_type_update/',
    save_leave_type: 'save_new_leave_type',

    // study material routes
    get_study_materials: 'get_study_materials/',

    // teacher get students
    get_level_student: 'get_level_student/',
    teacher_get_student_assessment: 'get_student_records/',
    teacher_get_terms: 'teacher_get_terms/',
    teacher_get_subjects: 'teacher_get_subjects/',
    teacher_get_other_details: 'get_other_details',
    teacher_get_terms_from_academic_session: 'get_terms_from_academic_session/',
    teacher_get_time_tables: 'get_time_tables',
    teacher_get_classes: 'get_teacher_classes',
    teacher_get_assignment: 'get_assignments',
    teacher_save_assignment: 'save_assignment',
    teacher_save_assessment: 'save_assessment',
    teacher_get_students_from_classes: 'get_students_from_class/',
    teacher_save_attendance: 'save_attendance/',
    teacher_get_student_info: 'get_student_info/',
    teacher_get_student_parents: 'get_student_parents/',
    teacher_get_student_assessment_records: 'get_assessment_records/',
    teacher_get_grade_scale: 'get_grade_scale',
    teacher_get_materials: 'get_teacher_materials',
    teacher_save_material: 'save_material',
    teacher_delete_material: 'delete_material/',
    teacher_assignment_submission: 'get_assignment_submission/',
    teacher_get_single_submission: 'get_single_submission/',
    teacher_save_assignment_score: 'save_assignment_score/',
    teacher_details_for_leave: 'get_details_for_leave',
    teacher_get_leave_application: 'get_leave_application',
    teacher_apply_leave: 'apply_for_leave',
    teacher_delete_application: 'delete_leave_application/',
    teacher_get_attendance_setup: 'get_attendance_setup',
    teacher_save_attendance_setup: 'save_attendance_setup',


    // student routes
    student_login: 'student-login',
    student_get_assessment: 'get_student_assessments',
    student_get_time_table: 'get_student_time_table',
    student_get_home_work: 'get_student_home_work',

}



// let hide_alert = () => {
//     setTimeout(() => {
//        $(".alert").delay(3200).fadeOut(300);
//     }, 12000);
// }


var institution_and_empty_field_error = 'Some fields are missing and if you have not selected an institution, it\'s at the top right of your screen , please do so'
var server_error = 'something went wrong';


