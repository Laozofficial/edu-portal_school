
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        grade_scale: [],
    },
    mounted() {
        this.get_grade_scale();
    },
    methods: {
        get_grade_scale() {
            axios.get(`${url.teacher_get_grade_scale}`, config)
                .then((response) => {
                    console.log(response);
                    this.grade_scale = response.data.grade_scale;
                    this.showContent();
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`something went wrong ${error.response.status}`);
                })
        },
        showContent() {
            this.loading = false;
            this.content = true;
        }
    }
})
