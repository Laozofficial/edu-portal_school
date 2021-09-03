new Vue({
    el: '#app',
    data: {
        email: email,
        otp: '',
        server_errors: []
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


        }

    },
})
