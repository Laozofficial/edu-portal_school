Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el:'#app',
    data: {
        loading: true,
        content: false,

        levels: [],
        selected_level: '',

        sessions: [],
        selected_session: '',

        terms: [],
        selected_term: '',

        subjects: [],
        selected_subject: '',

        submission_date: '',
        assignment: '',

        assignments: [],

        page: 1,
        loading_assignments: false,
    },
    mounted() {
        this.get_teacher_classes();
        this.get_assignments()
    },
    methods: {
        get_teacher_classes() {
            axios.get(`${url.teacher_get_classes}`, config)
                .then((response) => {
                    console.log(response);
                    this.levels = response.data.levels;
                    this.sessions = response.data.sessions;
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
            this.content = true;
            this.loading = false;
        },
        get_assignments() {
            this.loading_assignments = true;
            swal.fire('Please wait ...');
            swal.showLoading();

            axios.get(`${url.teacher_get_assignment + '?page=' + this.page}`, config)
                .then((response) => {
                    console.log(response);
                    this.assignments = response.data.assignments;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`something went wrong ${error.response.status}`);
                })
                .then(() => {
                    swal.close();
                    this.loading_assignments = false;
                });
        },
        get_term() {
            swal.fire('Please wait....');
            swal.showLoading();

            axios.get(`${url.teacher_get_terms + this.selected_session}`, config)
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
        get_subjects() {
            swal.fire('Please wait...');
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
                .then(() => {
                    swal.close();
                });
        },
        onAssignmentChange(event) {
            this.assignment = event.target.files[0];
        },
        save_assignment() {
            if (this.selected_level == '' || this.selected_session == '' || this.selected_subject == '' || this.selected_terms == '' || this.submission_date == '' || this.assignment == '') {
                swal.fire('oops', 'some fields are still empty', 'error');
            } else {
                swal.fire('Please wait.....');
                swal.showLoading();

                let fd = new FormData;
                fd.append('level_id', this.selected_level);
                fd.append('session_id', this.selected_session);
                fd.append('subject_id', this.selected_subject);
                fd.append('term_id', this.selected_term);
                fd.append('submission_date', this.submission_date);
                fd.append('assignment', this.assignment);

                axios.post(`${url.teacher_save_assignment}`, fd, config)
                    .then((response) => {
                        console.log(response);
                        swal.close();
                        swal.fire('Weldon', response.data.success, 'success');
                    })
                    .catch((error) => {
                        console.log(error);
                        swal.close();
                        toastr.error(`something went wrong ${error.response.status}`);
                    });
            }
        },
        pageChange(page) {
            if (this.page != page && page != 0) {
                this.page = page;
                this.get_assignments();
            }
        },
    }
})
