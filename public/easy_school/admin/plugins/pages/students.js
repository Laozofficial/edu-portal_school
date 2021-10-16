Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        institutions: [],
        selected_institution: '',

        students: [],
        loading_students: true,
        page: 1,

        q: '',
        student: {},

        classes: '',
        selected_class: '',

        is_button_active: true,

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
        get_students() {
            swal.fire({
                text: 'Please wait...',
                allowOutsideClick: false
            });
            swal.showLoading();

            axios.get(`${url.get_students + this.selected_institution + '?page=' + this.page}`, config)
                .then((response) => {
                    console.log(response);
                    this.students = response.data.students;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error('something went wrong');
                })
                .then(() => {
                    swal.close();
                });
        },
        pageChange(page) {
            if (this.page != page && page != 0) {
                this.page = page;
                this.get_students();
            }
        },
        search_student() {
            if (this.q == '') {
                swal.fire('Oops', 'Please type student name or email', 'error');
            } else {
                if (this.selected_institution == '') {
                    swal.fire('Oops', 'Please Select Institution', 'error');
                } else {
                    swal.fire({
                        text: 'Please wait...',
                        allowOutsideClick: false
                    });
                    swal.showLoading();

                    axios.get(`${url.search_student + this.q + '/' + this.selected_institution}`, config)
                        .then((response) => {
                            console.log(response);
                            swal.close();
                            if (response.data.students.data.length < 1) {
                                swal.fire('Oops', 'Student with that first name or last name is not on the system', 'error');
                            } else {
                                this.students = [];
                                this.students = response.data.students;
                            }
                        })
                        .catch((error) => {
                            swal.close();
                            console.log(error);
                            toastr.error(`something went wrong ${error.response.state}`);
                        });
                }
            }
        },
        assign_to_class(id) {
            swal.fire('please wait ....');
            swal.showLoading();

            axios.get(`${url.get_single_student + id + '/' + this.selected_institution}`, config)
                .then((response) => {
                    console.log(response);
                    swal.close();
                    this.student = response.data.student;
                    this.classes = response.data.classes;

                    if (this.student.level !== null) {
                        this.selected_class = this.student.level.name;
                    } else {
                        this.selected_class = '';
                    }
                    $('#assign-class').modal('show');
                })
                .catch((error) => {
                    console.log(error);
                    swal.close();
                    toastr.error(`something went wrong ${error.response.status}`);
                })
        },
        assign_class() {
            if (this.selected_class == '') {
                swal.fire('oops', 'Please Select a class', 'error');
            } else {
                swal.fire('please wait ....');
                swal.showLoading();

                let fd = new FormData;
                fd.append('level', this.selected_class);

                axios.post(`${url.assign_class + this.student.id}`, fd, config)
                    .then((response) => {
                        console.log(response);
                        $('#assign-class').modal('hide');
                        swal.close();
                        swal.fire('weldon', response.data.success, 'success');
                        this.get_students();
                    })
                    .catch((error) => {
                        console.log(error);
                        swal.close();
                        toastr.error(`something went wrong ${error.response.status}`);
                    })
                    .then(() => {
                        setTimeout(() => {
                            swal.close();
                        }, 3000);
                    });
            }
        },
        hide_button_when_class_is_not_selected() {
            if (Number.isInteger(this.selected_class)) {
                this.is_button_active = false;
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
        }
    },

});
