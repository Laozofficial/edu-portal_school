Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,
        loading_teachers: false,

        institutions: [],
        selected_institution: '',

        page: 1,

        students: [],

         student: {},

        classes: '',
        selected_class: '',

        loading_students: false,
        avatar: '',
        password: '',
        password_confirmation: '',

        alert: false,
        errors: []
    },
    mounted() {
        this.get_schools();
    },
    methods: {
        get_schools() {
            axios.get(`${url.get_all_schools}`, config)
                .then((response) => {
                    console.log(response);
                    this.institutions = response.data.institutions;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error('something went wrong');
                })
                .then(() => {
                    this.showContent();
                });
        },
        showContent() {
            this.loading = false;
            this.content = true;
        },
        get_alumni() {
            swal.fire('Please wait.....');
            swal.showLoading();
            this.loading_students = true;

            axios.get(`${url.get_student_alumni + this.selected_institution + '?page=' + this.page}`, config)
                .then((response) => {
                    console.log(response);
                    this.students = response.data.students;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`something went wrong ${error.response.status}`);
                })
                .then(() => {
                    swal.close();
                    this.loading_students = false;
                });
        },
        remove_as_alumni(id) {
            swal({
                    title: "Are you sure?",
                    text: "Once done, Student will be removed as an alumni and will be be given access to school day to day activity",
                    type: "warning",
                    showConfirmButton: true,
                    cancelButtonText: "Cancel",
                    showCancelButton: true,
                })
                .then((isConfirmed) => {
                    console.log(isConfirmed.dismiss)
                    if (isConfirmed.dismiss == 'cancel' || isConfirmed.dismiss == 'overlay') {
                        console.log('do nothing')
                    } else {
                        swal('please wait ....');
                        swal.showLoading();

                        axios.get(`${url.remove_as_alumni + id}`, config)
                            .then((response) => {
                                console.log(response);
                                swal.close();
                                swal('Weldon', response.data.success, 'success');
                                this.get_alumni();
                            })
                            .catch((error) => {
                                console.log(error);
                                toastr.error(`something went wrong, ${response.data.status}`);
                            });
                    }
                });
        },
        pageChange(page) {
            if (this.page != page && page != 0) {
                this.page = page;
                this.get_alumni();
            }
        },
        update_student(id) {
                swal.fire('please wait ....');
                swal.showLoading();

                axios.get(`${url.get_single_student + id + '/' + this.selected_institution}`, config)
                    .then((response) => {
                        console.log(response);
                        swal.close();
                        this.student = response.data.student;
                        this.classes = response.data.classes;

                        $('#update_school').modal('show');
                    })
                    .catch((error) => {
                        console.log(error);
                        swal.close();
                        toastr.error(`something went wrong ${error.response.status}`);
                    })
            },
            onPassportChange(event) {
                this.avatar = event.target.files[0];
            },
            update_profile() {
                if (this.student.first_name == '' || this.student.last_name == '' || this.student.present_address == '' || this.student.date_of_birth == '') {
                    swal.fire('Oops', 'some fields are missing', 'error');
                } else {
                    swal.fire('Please wait .....');
                    swal.showLoading();

                    let fd = new FormData;
                    fd.append('first_name', this.student.first_name);
                    fd.append('middle_name', this.student.middle_name);
                    fd.append('last_name', this.student.last_name);
                    fd.append('date_of_birth', this.student.date_of_birth);
                    fd.append('present_address', this.student.present_address);
                    fd.append('avatar', this.avatar);
                    fd.append('password', this.password);
                    fd.append('password_confirmation', this.password_confirmation);

                    axios.post(`${url.update_student + this.student.id}`, fd, config)
                        .then((response) => {
                            console.log(response);
                            swal.close();
                            this.get_students();
                            $('#update_school').modal('show');
                            swal.fire('Weldon', response.data.success, 'success');
                        })
                        .catch((error) => {
                            console.log(error);
                            swal.close();
                            this.errors = error.response.data.errors;
                            this.alert = true;
                            toastr.error(`something went wrong ${error.response.status}`);
                        })
                }
            },
            view_student(id) {
                window.location.href = '/dashboard/admin/student-details/' + id;
            },
            showContent() {
                this.loading = false;
                this.content = true;
            },
    }
});
