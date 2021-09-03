new Vue({
    el: '#app',
    data: {
        email: '',
        password: '',

        server_errors: [],
        server_errors_switch: false
    },
    mounted() {
        
    },
    methods: {
        login() {
            if (this.email == '' || this.password == '') {
                swal.fire('Oops...', 'Some fields empty', 'error');
            } else {
                swal.fire('please wait...');
                swal.showLoading();

                let fd = new FormData;
                fd.append('email', this.email);
                fd.append('password', this.password);

                axios.post(`${url.login}`, fd)
                    .then((response) => {
                        console.log(response);
                        toastr.success(response.data.success);
                        window.localStorage.setItem('token', JSON.stringify(response.data.token));
                        window.localStorage.setItem('user', JSON.stringify(response.data.user));
                        swal.close();
                        setTimeout(() => {
                            window.location.href = '/dashboard/index';
                        }, 2000);
                        // this.user = JSON.parse(window.localStorage.getItem('user'));
                    })
                    .catch((error) => {
                        console.log(error.response.data.errors);
                        this.server_errors = error.response.data.errors;
                        this.server_errors_switch = true;
                        swal.close();
                    });
            }
        }        
    },
})