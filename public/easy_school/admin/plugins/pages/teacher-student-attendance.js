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

        levels: [],
        selected_levels: '',

        sessions: [],
        selected_session: '',

        terms: [],
        selected_term: '',

        student: {},

        status: '',

        date_recorded: '',

        page: 1,
        loading_students: false
    },
    mounted() {
        this.get_classes();
    },
    methods: {
         get_classes() {
            axios.get(`${url.teacher_get_classes}`, config)
                .then((response) => {
                    console.log(response);
                    this.classes = response.data.levels;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`something went wrong ${error.response.status}`);
                })
                .then(() => {
                    this.showContent();
                });
        },
        get_students() {
            this.loading_students = true;
            swal.fire('Please wait.....');
            swal.showLoading();

            axios.get(`${url.teacher_get_students_from_classes + this.selected_class + '?page=' + this.page}`, config)
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
        pageChange(page) {
            if (this.page != page && page != 0) {
                this.page = page;
                this.get_students();
            }
        },
        showContent() {
            this.loading = false;
            this.content = true;
        },
        add_attendance(id) {
            swal.fire('Please wait...');
            swal.showLoading();

            axios.get(`${url.teacher_get_student_assessment + id}`, config)
                .then((response) => {
                    console.log(response);
                    swal.close();
                    this.sessions = response.data.sessions;
                    this.levels = response.data.levels;
                    this.student = response.data.student;
                    $('#attendance').modal('show');
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
        record_attendance(id) {

        }
    }
})
