// this file handles any authentication for the frontend of the app
let token = '';
let user = {};
var config = {};
let school = {};
let schools = [];

  console.log(config);




let get_token = () => {
    token = JSON.parse(window.localStorage.getItem('token'));
    config = {
        headers: {
            Authorization: "Bearer " + token
        }
    };

    console.log(config);
    // console.log(config);
    if (token === null) {
        if (window.location.pathname == '/dashboard/auth/register' || window.location.pathname == '/dashboard/auth/login' || window.location.pathname == '/dashboard/auth/otp-verification') {

        } else {
            window.location.href = '/dashboard/auth/login';
        }
    }
};

// let check_if_user_has_school = () => {
//     axios.get(`${url.validate_user_school}`, config)
//         .then((response) => {
//             console.log(response);
//         })
//         .catch((error) => {
//             console.log(error);
//         })
// };

let remove_token_and_redirect_to_login = () => {
    window.localStorage.removeItem('token');
    window.localStorage.removeItem('user');
    window.location.href = '/dashboard/auth/login';
};

let get_user = () => {
    user = JSON.parse(window.localStorage.getItem('user'));
    $('#user_name').html(user.name);
};

$("#logout-button").click(function(){
    remove_token_and_redirect_to_login();
});




get_token();
get_user();
// check_if_user_has_school();

