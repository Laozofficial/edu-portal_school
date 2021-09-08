let check_if_user_has_school = () => {
    if (window.location.pathname == '/dashboard/auth/register' || window.location.pathname == '/dashboard/auth/login' || window.location.pathname == '/dashboard/auth/otp-verification') {

    } else {
        axios.get(`${url.validate_user_school}`, config)
            .then((response) => {
                console.log(response);
                if (response.data.has_school === 0) {
                    window.location.href = '/dashboard/admin/add-school';
                } else {
                    window.localStorage.setItem('school', JSON.stringify(response.data.school));
                    window.localStorage.setItem('schools', JSON.stringify(response.data.schools));
                    school = JSON.parse(window.localStorage.getItem('school'));
                    schools = JSON.parse(window.localStorage.getItem('schools'));

                    schools.forEach(institution => {
                        $('#schools_list').html('<li id="change_school_id"  data-id="' + institution.id + '"><a class="dropdown-item" >' + institution.name + '</a></li>');
                    });
                    $('#school_logo').html('<img src="' + school.full_logo_path + '" width="20" alt=""/>');
                }
            })
            .catch((error) => {
                console.log(error);
            });
    }
};

// TODO: FIX THE PART WHERE THEY CAN SWITCH ACCOUNTS

$(document).ready(function(){
    $('#change_school_id').click(function () {
        console.log('clicked');
        console.log($(this).attr("data-id"));
    });
});


check_if_user_has_school();
