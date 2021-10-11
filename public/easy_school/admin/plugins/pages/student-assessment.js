Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        institutions: [],
        selected_institution: '',

        students: [],
        selected_student: '',

        sessions: [],
        selected_session: '',

        levels: [],
        selected_level: '',

        subjects: [],
        selected_subject: '',

        terms: [],
        selected_term: '',

        assessment_types: [],
        selected_assessment_type: '',

        ca: '',
        score: '',

        page: 1,

        q: '',
        student: {},
        loading_students: false,
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
        record_assessment(id) {
            swal.fire('please wait...');
            swal.showLoading();

            axios.get(`${url.get_details_to_assessment + this.selected_institution + '/'+ id}`, config)
                .then((response) => {
                    console.log(response);
                    this.levels = response.data.levels;
                    this.sessions = response.data.sessions;
                    this.subjects = response.data.subjects;
                    this.student = response.data.student;
                    this.assessment_types = response.data.assessment_types;

                    $('#record_assessment').modal('show');
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`something went wrong ${error.response.status}`);
                })
                .then(() => {
                    swal.close();
                });
        },
        get_terms() {
            swal.fire('please wait ....');
            swal.showLoading();

            axios.get(`${url.get_terms_from_academic_session + this.selected_session}`, config)
                .then((response) => {
                    console.log(response);
                    this.terms = response.data.terms;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`something went wrong ${error.response.status}`);
                })
                .then(() => {
                    swal.close();
                });
        },
        save_assessment() {
            if (this.selected_institution == '') {
                swal.fire('Oops', 'Please Select an Institution', 'error');
            } else {
                if (this.selected_level == '' || this.selected_session == '' || this.student.id == '' || this.selected_subject == '' || this.selected_term == '' || this.score == '' || this.selected_assessment_type == '') {
                    swal.fire('Oops', 'some fields are missing', 'error');
                } else {
                     swal.fire('Please wait ....');
                     swal.showLoading();

                     let fd = new FormData;
                     fd.append('academic_year_id', this.selected_session);
                     fd.append('level_id', this.selected_level);
                     fd.append('term_id', this.selected_term);
                     fd.append('student_id', this.student.id);
                     fd.append('institution_id', this.selected_institution);
                     fd.append('subject_id', this.selected_subject);
                     fd.append('assessment_type_id', this.selected_assessment_type);
                     fd.append('score', this.score);

                    axios.post(`${url.save_student_assessment}`, fd, config)
                        .then((response) => {
                            console.log(response);
                            $('#record_assessment').modal('hide');
                            swal.close();
                            swal.fire('Weldon', response.data.success, 'success');
                        })
                        .catch((error) => {
                            console.log(error);
                            swal.close();
                            if (error.response.data.error) {
                                swal.fire('Oops', error.response.data.error, 'error');
                            }
                            toastr.error(`something went wrong ${error.response.status}`);
                        });
                }
           }
        },
        go_to_student() {
            window.location.href = '/dashboard/admin/students';
        },
        get_student_assessments(id) {
            window.location.href = '/dashboard/admin/single_assessment_view/' + id;
        },
        showContent() {
            this.loading = false;
            this.content = true;
        }
    }
})
