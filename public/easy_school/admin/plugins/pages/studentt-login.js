new Vue({
    el: '#app',
    data: {
        s_id: '',
        password: '',

        server_errors: [],
        server_errors_switch: false,

        type: 'password',
    },
    mounted() {

    },
    methods: {
        login() {
            this.server_errors = [];
            this.server_errors_switch = false;
            if (this.s_id == '' || this.password == '') {
                swal.fire('oops', 'some fields are missing', 'error');
            } else {
                swal.fire('Please wait ....');
                swal.showLoading();



                let fd = new FormData;
                fd.append('s_id', this.s_id);
                fd.append('password', this.password);

                axios.post(`${url.student_login}`, fd)
                    .then((response) => {
                        console.log(response);
                        toastr.success(response.data.success);
                        window.localStorage.setItem('token', JSON.stringify(response.data.token));
                        window.localStorage.setItem('user', JSON.stringify(response.data.user));
                        setTimeout(() => {
                            window.location.href = '/dashboard/student/index';
                        }, 2000);
                    })
                    .catch((error) => {
                        console.log(error);
                        this.server_errors = error.response.data.errors;
                        this.server_errors_switch = true;
                        toastr.error(`something went wrong ${error.response.status}`);
                    })
                    .then(() => {
                        swal.close();
                    });
            }
        },
        show_password() {
            if (this.type === 'password') {
                this.type = 'text';
            } else {
                this.type = 'password';
            }
        }
    }
})
