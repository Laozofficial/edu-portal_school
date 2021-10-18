new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,
        selected_level: '',
        classes: [],
        students: [],
        page: 1,
        loading_students: false,

    },
    mounted() {
        this.get_classes();
    },
    methods: {
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
        fetch_students(id) {
            this.selected_level = id;
            swal.fire('Please wait.....');
            swal.showLoading();

            axios.get(`${url.get_level_student + id + '?page=' + this.page}`, config)
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
                });
        },
        pageChange(page) {
            if (this.page != page && page != 0) {
                this.page = page;
                this.fetch_students();
            }
        },
        view_student(id) {
             window.location.href = '/dashboard/admin/student-details/' + id;
        },
    }
})
