Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        teacher: {},

        server_error_switch: false,
        server_errors: [],

        image:'',

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
            this.image = event.target.files[0];
        },
        validate() {
            if (this.teacher.first_name == '' || this.teacher.last_name == '' || this.teacher.user.phone == ''  || this.teacher.religion == '' || this.teacher.qualification == '' || this.teacher.present_address == '') {
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

            axios.post(`${url.update_teacher + slug}`, this.teacher, config)
                .then((response) => {
                    console.log(response);
                    swal.close();
                    swal('Weldon', response.data.success, 'success');
                })
                .catch((error) => {
                    console.log(error);
                    this.server_errors = error.response.data.errors;
                    this.server_error_switch = true;
                    swal.close();
                    toastr.error('something went wrong');
                })
                .then(() => {
                    this.get_teacher();
                });
        },
        upload_image(slug) {
            swal.fire({
                  text: 'Please wait...',
                  allowOutsideClick: false
            });
            swal.showLoading();

            let fd = new FormData;
            fd.append('image', this.image);

            axios.post(`${url.update_teacher_passport + slug}`, fd, config)
                .then((response) => {
                    console.log(response);
                    swal.close();
                    swal.fire('Weldon', response.data.success, 'success');
                })
                .catch((error) => {
                    swal.close();
                    console.log(error);
                    toastr.error('something went wrong');
                })
                .then(() => {
                    $('.image_upload').modal('show');
                });
        },
    },
})
