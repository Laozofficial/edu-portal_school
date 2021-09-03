new Vue({
    el: '#app',
    data: {
        email: email,
        otp: '',
        server_errors: '',
        server_errors_switch: false
    },
    mounted() {

    },
    methods: {
        resend_otp() {
            swal.fire({
                text: 'resending otp.....',
                 allowOutsideClick: false
            })
            swal.showLoading();

            let fd = new FormData;
            fd.append('email', this.email);

            axios.post(`${url.resend_otp}`, fd)
                .then((response) => {
                    console.log(response);
                    toastr.success(response.data.success);
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error('something went wrong');
                })
                .then(() => {
                    swal.close();
                });


        },
        verify_otp() {
            if (this.otp == '') {
                swal.fire({
                    text: 'Please enter OTP'
                });
            } else {
                swal.fire({
                    text: 'sending otp.....',
                    allowOutsideClick: false
                })
                swal.showLoading();


                let fd = new FormData;
                fd.append('email', this.email);
                fd.append('otp', this.otp);

                axios.post(`${url.verify_otp}`, fd)
                    .then((response) => {
                        console.log(response);
                        toastr.success(response.data.success);
                        swal.close();
                        setTimeout(() => {
                            window.location.href = '/dashboard/auth/login';
                        }, 2000);
                    })
                    .catch((error) => {
                        console.log(error);
                        this.server_errors = error.response.data.errors;
                        this.server_errors_switch = true;
                        swal.close();
                    })
             }
        }

    },
})
