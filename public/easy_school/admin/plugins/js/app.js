let url = {
    register: 'auth/register',
    resend_otp: 'auth/resend_otp',
    verify_otp: 'auth/verify-otp',
    login: 'auth/login',

    // check if user has a school
    validate_user_school: 'validate_user_school',

    // check items
    get_classes_and_teachers: 'get_classes_and_teachers/',

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

    // classes
    save_class: 'save_class',
    get_single_class: 'get_single_class/',
    update_single_class: 'update_single_class/',

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


    // students Routes
    get_students:  'get_students/',
    save_student: 'save_student/',
    search_student: 'search_student/',
    get_single_student: 'get_single_student/',
    assign_class: 'assign_class_to_student/',

    // time table routes
    get_other_details: 'get_other_details/',
    get_terms_from_academic_session: 'get_terms_from_academic_session/',
    save_time_table: 'save_time_table',
    get_time_tables: 'get_time_tables/',
    delete_time_table: 'delete_time_table/',

}



let hide_alert = () => {
    setTimeout(() => {
       $(".alert").delay(3200).fadeOut(300);
    }, 2000);
}


var institution_and_empty_field_error = 'Some fields are missing and if you have not selected an institution, it\'s at the top right of your screen , please do so'




hide_alert();
