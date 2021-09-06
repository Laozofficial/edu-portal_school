// this file handles any authentication for the frontend of the app
let token = '';
let user = {};
let config = {};


let get_token = () => {
    token = window.localStorage.getItem('token');
    config = {
        headers: {
            Authorization: "Bearer " + token
        }
    };
    // console.log(config);
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

let get_user = () => {
    user = JSON.parse(window.localStorage.getItem('user'));
}

$("#logout-button").click(function(){
    remove_token_and_redirect_to_login();
});


get_token();
get_user();

