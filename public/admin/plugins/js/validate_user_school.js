let check_if_user_has_school = () => {
        if (window.location.pathname == '/dashboard/auth/register' || window.location.pathname == '/dashboard/auth/login' || window.location.pathname == '/dashboard/auth/otp-verification') {

        } else {
            axios.get(`${url.validate_user_school}`, config)
                .then((response) => {
                    console.log(response);
                    if (response.data.has_school === 0) {
                        window.location.href = '/dashboard/admin/add-school';
                    } else {
                        window.location.href = '/dashboard/admin/index';
                    }
                })
                .catch((error) => {
                    console.log(error);
                })
        }
};


check_if_user_has_school();
