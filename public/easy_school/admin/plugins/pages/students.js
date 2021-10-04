Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        institutions: [],
        selected_institution: '',

        students: [],
        loading_students: true,
        page: 1,

        q: '',
        student: {},

        classes: '',
        selected_class: '',
    },
    mounted() {
        this.get_schools();
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
        get_students() {
             swal.fire({
                 text: 'Please wait...',
                 allowOutsideClick: false
             });
             swal.showLoading();

            axios.get(`${url.get_students + this.selected_institution + '?page=' + this.page}`, config)
                .then((response) => {
                    console.log(response);
                    this.students = response.data.students;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error('something went wrong');
                })
                .then(() => {
                    swal.close();
                });
        },
        pageChange(page) {
            if (this.page != page && page != 0) {
                this.page = page;
                this.get_students();
            }
        },
        search_student() {
            if (this.q == '') {
                swal.fire('Oops', 'Please type student name or email', 'error');
            } else {
                if (this.selected_institution == '') {
                    swal.fire('Oops', 'Please Select Institution', 'error');
                } else {
                    swal.fire({
                        text: 'Please wait...',
                        allowOutsideClick: false
                    });
                    swal.showLoading();

                    axios.get(`${url.search_student + this.q + '/' + this.selected_institution}` , config)
                        .then((response) => {
                            console.log(response);
                            swal.close();
                            if (response.data.students.data.length < 1) {
                                swal.fire('Oops', 'Student with that first name or last name is not on the system', 'error');
                            } else {
                                this.students = [];
                                this.students = response.data.students;
                            }
                        })
                        .catch((error) => {
                            swal.close();
                            console.log(error);
                            toastr.error(`something went wrong ${error.response.state}`);
                        });
                }
            }
        },
        assign_to_class(id) {
            swal.fire('please wait ....');
            swal.showLoading();

            axios.get(`${url.get_single_student + id + '/' + this.selected_institution}`, config)
                .then((response) => {
                    console.log(response);
                    swal.close();
                    this.student = response.data.student;
                    this.classes = response.data.classes;
                    $('#assign-class').modal('show');
                })
                .catch((error) => {
                    console.log(error);
                    swal.close();
                    toastr.error(`something went wrong ${error.response.status}`);
                })
        },
        showContent() {
            this.loading = false;
            this.content = true;
        }
    },
})
