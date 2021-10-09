Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
         loading: true,
        content: false,

        institutions: [],
        selected_institution: '',

        page: 1,

        students: [],
    },
    mounted() {
        this.get_schools();
        this.get_students_from_a_class();
        // console.log(this.students)
        console.log('hello')
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
        pageChange(page) {
            if (this.page != page && page != 0) {
                this.page = page;
                // this.get_s;
            }
        },
        get_students_from_a_class() {
            axios.get(`${url.get_students_for_class + id}`, config)
                .then((response) => {
                    console.log(response);
                    this.students = response.data.students;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`something went wrong ${error.response.status}`);
                })
        },
        student_details(id) {
            window.location.href = '/dashboard/admin/student-details/' + id;
        },
        showContent() {
            this.loading = false;
            this.content = true;
        },
    }
})
