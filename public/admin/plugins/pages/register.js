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

            }
        }
    },
})
