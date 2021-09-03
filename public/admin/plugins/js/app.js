let url = {
    register: 'auth/register',
    resend_otp: 'auth/resend_otp',
    verify_otp: 'auth/verify-otp',
    login: 'auth/login',
}


let token = '';

let hide_alert = () => {
    setTimeout(() => {
       $(".alert").delay(3200).fadeOut(300);
    }, 2000);
}

let get_token = () => {
    token = localStorage.getItem('token');
    if (token === null) {
       if (window.location.pathname == '/dashboard/auth/register' || window.location.pathname == '/dashboard/auth/login' || window.location.pathname == '/dashboard/auth/otp-verification') {

       }else {
         window.location.href = '/dashboard/auth/login';
       }
    }
}


hide_alert();
// get_token();
