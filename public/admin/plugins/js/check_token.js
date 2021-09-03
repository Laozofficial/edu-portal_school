let get_token = () => {
   let  token = localStorage.getItem('token');
    if (token === null) {
        if (window.location.pathname == '/dashboard/auth/register' || window.location.pathname == '/dashboard/auth/login' || window.location.pathname == '/dashboard/auth/otp-verification') {

        } else {
            window.location.href = '/dashboard/auth/login';
        }
    }
};

let remove_token_and_redirect_to_login = () => {
    window.localStorage.removeItem('token');
    window.localStorage.removeItem('user');
    window.location.href = '/dashboard/auth/login';
}

$("#logout-button").click(function(){
    remove_token_and_redirect_to_login();
});


get_token();


