let url = {
    register: 'auth/register',
    resend_otp: 'auth/resend_otp',
    verify_otp: 'auth/verify-otp',
    login: 'auth/login',


    // school admin
    get_details_for_registration: 'get_details_for_registration',
    save_institution: 'save_institution',
}



let hide_alert = () => {
    setTimeout(() => {
       $(".alert").delay(3200).fadeOut(300);
    }, 2000);
}






hide_alert();
