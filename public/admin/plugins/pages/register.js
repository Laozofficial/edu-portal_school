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


        name_error_switch: false,
        email_error_switch: false,
        phone_error_switch: false,
        password_error_switch: false,
        confirm_password_switch: false
    },
    mounted() {

    },
    methods: {
        validate(){
            if (this.name == '') {
                this.name_error = 'Name cannot be empty';
                this.name_error_switch = true;
            }
            if (this.email == '') {
                this.email_error = 'Email Cannot be Empty';
                this.email_error_switch = true;
            }
            if (this.phone_number == '') {
                this.phone_number_error = 'Phone Number Error';
                this.phone_error_switch = true;
            }
            if (this.password == '') {
                this.password_error = 'Password cannot be empty';
                this.password_error_switch = true;
            }
            if (this.password.length < 8) {
                this.password_error = 'Password cannot be less that 8 characters';
                this.password_error_switch = true;
            }
            if (this.password_confirmation == '') {
                this.confirm_password_error = 'Confirm Password Field is empty';
                this.confirm_password_switch = true;
            }
            if (this.password === this.password_confirmation) {
                this.confirm_password_error = 'Passwords doe not match';
                this.confirm_password_switch = true;
            }
        }
    },
})
