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

        page: 1,
        loading_assessment: false,

        student: {},

        parents: [],

        assessments: []
    },
    mounted() {
        this.get_student_info();
    },
    methods: {
        get_student_info() {
            axios.get(`${url.teacher_get_student_info + id}`, config)
                .then((response) => {
                    console.log(response);
                    this.student = response.data.student;
                    this.get_parents();
                    this.get_assessments();
                    this.showContent();
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`something went wrong ${error.response.status}`);
                });
        },
        get_parents() {
            swal.fire('Please wait..');
            swal.showLoading();

            axios.get(`${url.teacher_get_student_parents + this.student.id}`, config)
                .then((response) => {
                    console.log(response);
                    this.parents = response.data.parents;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`something went wrong ${error.response.status}`);
                })
                .then(() => {
                    swal.close();
                });
        },
        get_assessments() {
            this.loading_assessment = true;

            axios.get(`${url.teacher_get_student_assessment_records + this.student.id + '?page=' + this.page}`, config)
                .then((response) => {
                    console.log(response);
                    this.assessments = response.data.assessments;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`something went wrong ${error.response.status}`);
                })
                .then(() => {
                    this.loading_assessment = false;
                });
        },
        pageChange(page) {
            if (this.page != page && page != 0) {
                this.page = page;
                this.get_assessments();
            }
        },
        showContent() {
            this.loading = false;
            this.content = true;
        },
    }
})
