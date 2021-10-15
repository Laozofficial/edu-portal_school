new Vue({
    el: '#app',
    data: {
        s_id: '',
        password: '',

        sever_errors: [],
        server_errors_switch: true
    },
    mounted() {

    },
    methods: {
        login() {
            if (this.s_id == '' || this.password == '') {
                swal.fire('oops', 'some fields are missing', 'error');
            } else {
                swal.fire('Please wait ....');
                swal.showLoading();

                let fd = new FormData;
                fd.append('s_id', this.s_id);
                fd.append('password', this.password);

                axios.post(`${url.teacher_login}`, fd, config)
                    .then((response) => {
                        console.log(response);
                        toastr.success(response.data.success);
                        window.localStorage.setItem('token', JSON.stringify(response.data.token));
                        window.localStorage.setItem('user', JSON.stringify(response.data.user));
                        swal.close();
                        setTimeout(() => {
                            window.location.href = '/dashboard/teacher/index';
                        }, 2000);

                    })
                    .catch((error) => {
                        console.log(error);
                        this.sever_errors = error.response.data.errors;
                        this.server_errors_switch = true;
                        toastr.error(`something went wrong ${error.response.status}`);
                    })
            }
        }
    }
})
