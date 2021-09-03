let url = {
    register: 'auth/register'
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
       if(window.location.pathname == '/dashboard/auth/register' || window.location.pathname == '/dashboard/auth/login') {

       }else {
         window.location.href = '/dashboard/auth/login';
       }
    }
}


hide_alert();
get_token();
