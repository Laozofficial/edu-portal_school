Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        institutions: [],
        selected_institution: '',

        grades: [],

        lower_value: '',
        upper_value: '',
        grade: '',

        single_grade: {}
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
        save_grade() {
            if (this.lower_value == '' || this.upper_value == '' || this.grade == '' || this.selected_institution == '') {
                swal.fire('Oops', 'Some fields are empty, do not forget to select the institution', 'error');
            } else {
                swal.fire({
                    text: 'Please wait...',
                    allowOutsideClick: false
                });
                swal.showLoading();

                let fd = new FormData;
                fd.append('lower_value', this.lower_value);
                fd.append('upper_value', this.upper_value);
                fd.append('grade', this.grade);

                axios.post(`${url.save_grades + this.selected_institution}`, fd, config)
                    .then((response) => {
                        console.log(response);
                        swal.close();
                        swal.fire('weldon', response.data.success, 'success');
                    })
                    .catch((error) => {
                        console.log(error);
                        swal.close();
                        toastr.error('something went wrong');
                    })
                    .then(() => {
                        this.get_grades();
                    });
            }
        },
        get_grades() {
            axios.get(`${url.get_grades + this.selected_institution}`, config)
                .then((response) => {
                    console.log(response);
                    this.grades = response.data.grades;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error('something went wrong');
                })
        },
        edit_grade(id) {
            swal.fire({
                text: 'Please wait...',
                allowOutsideClick: false
            });
            swal.showLoading();

            axios.get(`${url.get_single_grade + id}`, config)
                .then((response) => {
                    console.log(response);
                    swal.close();
                    this.single_grade = response.data.grade;
                    $('.update_grade').modal('show');
                })
                .catch((error) => {
                    console.log(error);
                    swal.close();
                    toastr.error('something went wrong');
                })
        },
        save_update_grade(id) {
            if (this.single_grade.grade == '' || this.single_grade.lower_value == '' || this.single_grade.upper_value == '') {
                swal.fire('Oops', 'some fields are empty', 'error');
            }else {
                swal.fire({
                    text: 'Please wait...',
                    allowOutsideClick: false
                });
                swal.showLoading();

                let fd = new FormData;
                fd.append('grade', this.single_grade.grade);
                fd.append('lower_value', this.single_grade.lower_value);
                fd.append('upper_value', this.single_grade.upper_value);

                axios.post(`${url.save_grade_update + id}`, fd, config)
                    .then((response) => {
                        console.log(response);
                        swal.close();
                        swal.fire('weldon', response.data.success, 'success');
                        $('.update_grade').modal('hide');
                        this.get_grades();
                    })
                    .catch((error) => {
                        console.log(error);
                        swal.close();
                        toastr.error('something went wrong');
                    })

            }
        },
        showContent() {
            this.loading = false;
            this.content = true;
        },
    },
})
