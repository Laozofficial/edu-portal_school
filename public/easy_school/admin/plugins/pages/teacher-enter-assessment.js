Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        classes: [],
        selected_class: '',

        students: [],
        selected_student: '',

        student: {},

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

        loading_students: false,
        page: 1,

        score: '',

        student_id: '',
        active_session: {},

        all_scores: []

    },
    mounted() {
        this.get_classes();
    },
    methods: {
        get_class_from_subject() {
            this.fetch_students();
            swal.fire('Loading subjects');
            swal.showLoading();

            axios.get(`${url.teacher_get_subjects + this.selected_class}`, config)
                .then((response) => {
                    console.log(response);
                    this.subjects = response.data.subjects;

                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`something went wrong ${error.response.status}`);
                })
                .then(() => {
                    swal.close();
                });
        },
        get_classes() {
            axios.get(`${url.teacher_classes}`, config)
                .then((response) => {
                    console.log(response);
                    this.classes = response.data.classes;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`something went wrong ${error.response.status}`);
                })
                .then(() => {
                    this.showContent();
                });
        },
        showContent() {
            this.loading = false;
            this.content = true;
        },
        handle_score(event) {
            console.log(event.target.value);
        },
        fetch_students() {
            swal.fire('Please wait.....');
            swal.showLoading();

            axios.get(`${url.get_level_student + this.selected_class + '?page=' + this.page}`, config)
                .then((response) => {
                    console.log(response);
                    this.students = response.data.students;
                    this.active_session = response.data.session;
                    this.assessment_types = response.data.assessments;
                    this.get_terms();
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`something went wrong ${error.response.status}`);
                })
                .then(() => {
                    swal.close();
                });
        },
        pageChange(page) {
            if (this.page != page && page != 0) {
                this.page = page;
                this.fetch_students();
            }
        },
        add_assessment(id) {
            swal.fire('please wait ....');
            swal.showLoading();

            axios.get(`${url.teacher_get_student_assessment + id}`, config)
                .then((response) => {
                    console.log(response);
                    swal.close();
                    this.sessions = response.data.sessions;
                    this.levels = response.data.levels;
                    this.subjects = response.data.subjects;
                    this.assessment_types = response.data.assessment_types;
                    this.student = response.data.student;
                    this.student_id = response.data.student.id;
                    // $('#record_assessment').modal('show');
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
            swal.fire('Please wait ....');
            swal.showLoading();

            axios.get(`${url.teacher_get_terms + this.active_session.id}`, config)
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
        get_subjects_in_a_class() {
            swal.fire('Please wait .....');
            swal.showLoading();

            axios.get(`${url.teacher_get_subjects + this.selected_level}`, config)
                .then((response) => {
                    console.log(response);
                    this.subjects = response.data.subjects;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`something went wrong ${error.response.status}`);
                })
                .then((response) => {
                    swal.close();
                });
        },
        save_assessment(id) {
            if (this.selected_assessment_type == '' || this.selected_class == '' || this.selected_subject == '' || this.selected_term == '' || this.score == '') {
                swal.fire('error', 'some fields are empty', 'error');
            } else {
                swal.fire('Please wait....');
                swal.showLoading();

                let fd = new FormData;
                fd.append('assessment_type_id', this.selected_assessment_type);
                fd.append('level_id', this.selected_class);
                fd.append('session_id', this.selected_session);
                fd.append('subject_id', this.selected_subject);
                fd.append('term_id', this.selected_term);
                fd.append('score', this.score);
                fd.append('student_id', id);

                axios.post(`${url.teacher_save_assessment}`, fd, config)
                    .then((response) => {
                        console.log(response);
                        swal.close();
                        $('#record_assessment').modal('hide');
                        swal.fire('Weldon', response.data.success, 'success');
                        this.empty_values();
                    })
                    .catch((error) => {
                        console.log(error);
                        swal.fire('Oops', error.response.data.error, 'error');
                        toastr.error(`something went wrong ${error.response.status}`);
                    });
            }
        },
        empty_values() {
            this.selected_assessment_type = '';
            this.selected_level = '';
            this.selected_class = '';
            this.selected_subject = '';
            this.selected_term = '';
            this.score = '';
            this.student = {};
            this.assessment_types = [];
            this.levels = [];
            this.sessions = [];
            this.subjects = [];
            this.terms = [];
        }


    }
});
