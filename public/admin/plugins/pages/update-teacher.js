Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        teacher: {},

        server_error_switch: false,
        server_errors: [],

    },
    mounted() {
        this.get_teacher();
    },
    methods: {
        get_teacher() {
            axios.get(`${url.get_single_teacher + slug}`, config)
                .then((response) => {
                    console.log(response);
                    this.teacher = response.data.teacher;
                    this.showContent();
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error('something went wrong');
                });
        },
        showContent() {
            this.loading = false;
            this.content = true;
        },
        onPassportChange(event) {
            this.teacher.image = event.target.files[0];
        },
        validate() {
            if (this.first_name == '' || this.last_name == '' || this.phone == ''  || this.religion == '' || this.qualification == '' || this.present_address == '') {
                swal.fire('Oops..', 'some fields are missing, please fill in everything', 'error');
            } else {
                this.update_teacher();
            }
        },
        update_teacher() {
            swal.fire({
                text: 'Please wait...',
                allowOutsideClick: false
            });
            swal.showLoading();

            axios.post(`${url.update_teacher + slug}`, config)
                .then((response) => {
                    console.log(response);
                    swal.close();
                    swal('Weldon', response.data.success, 'success');
                })
                .catch((error) => {
                    console.log(error);
                    swal.close();
                    toastr.error('something went wrong');
                });
        },
    },
})
