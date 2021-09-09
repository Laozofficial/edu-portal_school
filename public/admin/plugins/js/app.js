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


}



let hide_alert = () => {
    setTimeout(() => {
       $(".alert").delay(3200).fadeOut(300);
    }, 2000);
}






hide_alert();
