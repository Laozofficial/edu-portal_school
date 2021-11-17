Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        submissions: [],
        page: 1,
        loading_submissions: false,

        submission: {
            student: {
                full_name_text: ''
            }
        },
        score: '',
    },
    mounted() {
        this.get_assignment_answers();
    },
    methods: {
        get_assignment_answers() {
            axios.get(`${url.teacher_assignment_submission + id + '?page=' + this.page}`, config)
                .then((response) => {
                    console.log(response);
                    this.submissions = response.data.submissions;
                    if (this.submissions.data.length < 1) swal.fire('Oops', 'there are no submissions on this assignments', 'error');
                    showContentView();
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`${server_error} ${error.response.status}`);
                });
        },
         pageChange(page) {
             if (this.page != page && page != 0) {
                 this.page = page;
                 this.get_assignment_answers();
             }
        },
        score_assignment(id) {
            axios.get(`${url.teacher_get_single_submission + id}`, config)
                .then((response) => {
                    console.log(response);
                    this.submission = response.data.submission;
                    $('.record_assignment').modal('show');
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`${server_error} ${error.response.status}`);
                });
        },
        store_score() {
            if (this.score == '') {
                swal.fire('Oops', 'Please enter a score', 'error');
            } else {
                swal.fire('Please wait...');
                swal.showLoading();

                let fd = new FormData;
                fd.append('score', this.score);

                axios.post(`${url.teacher_save_assignment_score + submission.id}`, fd, config)
                    .then((response) => {
                        console.log(response);
                        swal.fire('Weldon', response.data.success, 'error');
                    })
                    .catch((error) => {
                        console.log(error);
                        if (error.response.data.error) swal.fire('Oops', error.response.data.error, 'error');
                        toastr.error(`${server_error} ${error.response.status}`);
                    });
            }
        }
    }
});
