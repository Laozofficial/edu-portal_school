let url = {
    register: 'auth/register',
    resend_otp: 'auth/resend_otp',
    verify_otp: 'auth/verify-otp',
    login: 'auth/login',

    // check if user has a school
    validate_user_school: 'validate_user_school',


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
    save_teacher: 'save_teacher',


}



let hide_alert = () => {
    setTimeout(() => {
       $(".alert").delay(3200).fadeOut(300);
    }, 2000);
}






hide_alert();
