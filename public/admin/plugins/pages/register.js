new Vue({
    el: '#app',
    data: {
        name:'',
        email:'',
        phone_number: '',
        password:'',
        password_confirmation: '',


        name_error: '',
        email_error: '',
        phone_number_error: '',
        password_error: '',
        confirm_password_error: '',
        server_errors: [],


        name_error_switch: false,
        email_error_switch: false,
        phone_error_switch: false,
        password_error_switch: false,
        confirm_password_switch: false,
        server_error_switch: false
    },
    mounted() {

    },
    methods: {
        validate() {
            if (this.name == '' || this.email == '' || this.phone_number == '' || this.password == '' || this.password_confirmation == '') {
                swal.fire('Oops..', 'some fields are empty', 'error');

            } else {
                this.register();
            }
            // if (this.name == '') {
            //     this.name_error = 'Name cannot be empty';
            //     this.name_error_switch = true;
            // } else if (this.email == '') {
            //     this.email_error = 'Email Cannot be Empty';
            //     this.email_error_switch = true;
            // } else if (this.phone_number == '') {
            //     this.phone_number_error = 'Phone Number Error';
            //     this.phone_error_switch = true;
            // } else if (this.password == '') {
            //     this.password_error = 'Password cannot be empty';
            //     this.password_error_switch = true;
            // } else if (this.password.length < 8) {
            //     this.password_error = 'Password cannot be less that 8 characters';
            //     this.password_error_switch = true;
            // } else if (this.password_confirmation == '') {
            //     this.confirm_password_error = 'Confirm Password Field is empty';
            //     this.confirm_password_switch = true;
            // } else if (this.name !== '' && this.email !== '' && this.phone_number !== '' && this.password !== '' && this.password.length >= 8 && this.password_confirmation !== '' && this.password === this.password_confirmation) {
            //     console.log('validation passed');
            //     this.register();
            // }
        },

        register() {
            swal.fire({
                text: 'Please wait ....',
                allowOutsideClick: false
            });
            swal.showLoading();

            let fd = new FormData;
            fd.append('name', this.name);
            fd.append('email', this.email);
            fd.append('phone_number', this.phone_number);
            fd.append('password', this.password);
            fd.append('password_confirmation', this.password_confirmation);

            axios.post(`${url.register}`, fd)
                .then((response) => {
                    console.log(response);
                    swal.fire({
                        title: response.data.success,
                        text: response.data.message,
                        icon: 'success'
                    });
                    setTimeout(() => {
                        window.location.href = '/dashboard/auth/otp-verification/' + this.email;
                    }, 3000);
                    swal.close();
                })
                .catch((error) => {
                    console.log(error.response.data.errors);
                    this.server_errors = error.response.data.errors;
                    this.server_error_switch = true;
                    toastr.error('something went wrong');
                    swal.close();
                })
                // .then(() => {
                //     swal.close();
                // });
        }
    },
})
