new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,
        assessments: [],

        page: 1,
        loading_assessments: false
    },
    mounted() {
        this.get_student_assessment();
    },
    methods: {
        get_student_assessment() {
            this.loading_assessments = true;

            axios.get(`${url.student_get_assessment}`, config)
                .then((response) => {
                    console.log(response);
                    this.assessments = response.data.assessments;
                    showContentView();
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error('something went wrong');
                });
        },
        pageChange(page) {
            if (this.page != page && page != 0) {
                this.page = page;
                this.get_student_assessment();
            }
        },
    }
});
