new Vue({
    el: '#app',
    data: {
        email: email,
        otp: ''
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


        }

    },
})
