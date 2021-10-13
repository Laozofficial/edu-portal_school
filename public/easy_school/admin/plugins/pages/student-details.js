Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        student: {},
        assessments: {},

        loading_assessments: false,
        page: 1,

        assessment: {},

        parent: {
            full_name: '',
            email: '',
            phone: ''
        },

        errors: [],
        server_errors: false,

        parents: [],

        single_parent: {
            user: {}
        },

        new_password: ''
    },
    mounted() {
        this.get_student();
    },
    methods: {
        get_student() {
            swal.fire('Please wait ...');
            swal.showLoading();

            axios.get(`${url.get_single_student_by_id + id}`, config)
                .then((response) => {
                    console.log(response);
                    this.student = response.data.student;
                    this.get_student_assessments();
                    this.get_parents();
                    // this.assessments = response.data.assessments;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`something went wrong ${error.response.status}`);
                })
                .then(() => {
                    this.showContent();
                    swal.close();
                });
        },
        get_student_assessments() {
            this.loading_assessments = true;
            axios.get(`${url.get_student_assessments + id + '?page=' + this.page}`, config)
                .then((response) => {
                    console.log(response);
                    this.assessments = response.data.assessments;
                    this.showContent();
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`something went wrong ${error.response.status}`);
                })
                .then(() => {
                    this.loading_assessments = false;
                });
        },
        pageChange(page) {
            if (this.page != page && page != 0) {
                this.page = page;
                this.get_student_assessments();
            }
        },
        showContent() {
            this.loading = false;
            this.content = true;
        },
        update_score(id) {
            swal.fire('Please wait...');
            swal.showLoading();

            axios.get(`${url.get_single_assessment_for_student + id}`, config)
                .then((response) => {
                    console.log(response);
                    this.assessment = response.data.assessment;
                    $('#update_score').modal('show');
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`something went wrong ${error.response.status}`);
                })
                .then(() => {
                    swal.close();
                })
        },
        update_assessment_score() {
            if (this.assessment.score == '') {
                swal.fire('Oops', 'some fields are empty', 'error');
            } else {
                swal.fire('Please wait...');
                swal.showLoading();

                let fd = new FormData;
                fd.append('score', this.assessment.score);
                fd.append('assessment_type', this.assessment.assessment_type_id)

                axios.post(`${url.update_single_assessment + this.assessment.id}`, fd, config)
                    .then((response) => {
                        console.log(response);
                        swal.fire('Weldon', response.data.success, 'success');
                    })
                    .catch((error) => {
                        console.log(error);
                        if (error.response.data.error) {
                            swal.fire('Oops', error.response.data.error, 'error');
                        }
                        toastr.error(`something went wrong ${error.response.status}`);
                    })
                    .then(() => {
                        $('#update_score').modal('hide');
                        this.get_student_assessments();
                    });
            }
        },
        add_parent() {
            if (this.parent.full_name == '' || this.parent.email == '' || this.parent.phone == '') {
                swal.fire('Oops', 'some fields are missing', 'error');
            } else {
                swal.fire('Please wait....');
                swal.showLoading();

                let fd = new FormData;
                fd.append('name', this.parent.full_name);
                fd.append('email', this.parent.email);
                fd.append('phone', this.parent.phone);
                fd.append('student_id', this.student.id);

                axios.post(`${url.save_parent}`, fd, config)
                    .then((response) => {
                        console.log(response);
                        swal.close();
                        $('.add_parent').modal('hide');
                        swal.fire('Weldon', response.data.success, 'success');
                    })
                    .catch((error) => {
                        console.log(error.response);
                        this.errors = error.response.data.errors;
                        this.server_errors = true;
                        swal.close();
                        toastr.error(`something went wrong ${error.response.status}`);
                    });
            }
        },
        get_parents() {
            axios.get(`${url.get_parents + this.student.id}`, config)
                .then((response) => {
                    console.log(response);
                    this.parents = response.data.parents;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`something went wrong ${error.response.status}`);
                })
        },
        update_parent(id) {
            swal.fire('Please wait...');
            swal.showLoading();

            axios.get(`${url.get_single_parent + id}`, config)
                .then((response) => {
                    console.log(response);
                    swal.close();
                    this.single_parent = response.data.parent;
                    $('.update_parent').modal('show');
                })
                .catch((error) => {
                    console.log(error);
                    swal.close();
                    toastr.error(`something went wrong ${error.response.status}`);
                })
        },
        update_single_parent() {
            swal.fire('Please wait....');
            swal.showLoading();

            let fd = new FormData;
            fd.append('name', this.single_parent.user.name);
            fd.append('phone', this.single_parent.user.phone);

            axios.post(`${url.update_single_parent + this.single_parent.id}`, fd, config)
                .then((response) => {
                    console.log(response);
                    $('.update_parent').modal('hide');
                    swal.close();
                    swal.fire('Oops', response.data.success, 'success');
                })
                .catch((error) => {
                    console.log(error);
                    swal.close();
                    toastr.error(`something went wrong ${error.response.status}`);
                })
                .then(() => {
                    this.get_parents();
                });
        }
    }
});
