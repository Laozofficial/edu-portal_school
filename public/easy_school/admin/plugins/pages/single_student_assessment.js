Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        assessments: [],
        loading_assessments: false,

        page: 1,

        assessment: {},
        score: ''
    },
    mounted() {
        this.get_student_assessments();
    },
    methods: {
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
        showContent() {
            this.loading = false;
            this.content = true;
        },
        pageChange(page) {
            if (this.page != page && page != 0) {
                this.page = page;
                this.get_student_assessments();
            }
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
        }
    },
})
