Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        institutions: [],
        selected_institution: '',

        levels: [],
        selected_classes: '',

        teachers: [],
        selected_teacher: '',

        name: '',

        level: {},
        update_selected_teacher: '',

        loading_levels: false,
        page: 1,
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
        get_items() {
            this.loading_levels = true;
            swal.fire({
                text: 'Please wait...',
                allowOutsideClick: false
            });
            swal.showLoading();

            axios.get(`${url.get_classes_and_teachers + this.selected_institution + '?page=' + this.page}`, config)
                .then((response) => {
                    console.log(response);
                    swal.close();
                    this.levels = response.data.classes;
                    this.teachers = response.data.teachers;
                })
                .catch((error) => {
                    console.log(error);
                    swal.fire('Oops', error.response.data.error, 'error');
                    this.levels = error.response.data.classes;
                    console.log(error.response.data.classes);
                    this.teachers = error.response.data.teachers;
                    toastr.error('something went wrong');
                })
                .then(() => {
                    this.loading_levels = false;
                });
        },
        save_class() {
            if (this.name == '' || this.selected_institution == '' || this.selected_teacher == '') {
                swal.fire('oops', 'some fields are empty', 'error');
            } else {
                swal.fire({
                    text: 'Please wait...',
                    allowOutsideClick: false
                });
                swal.showLoading();

                let fd = new FormData;
                fd.append('name', this.name);
                fd.append('institution_id', this.selected_institution);
                fd.append('teacher_id', this.selected_teacher);

                axios.post(`${url.save_class}`, fd, config)
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
                        this.get_items();
                    });

            }
        },
        edit_school(id) {
            swal.fire({
                text: 'Please wait...',
                allowOutsideClick: false
            });
            swal.showLoading();

            axios.get(`${url.get_single_class + id}`, config)
                .then((response) => {
                    console.log(response);
                    swal.close();
                    this.level = response.data.level;
                    this.update_selected_teacher = response.data.level.teacher.full_name_text;
                    $('.update_class').modal('show');
                })
                .catch((error) => {
                    console.log(error);
                    swal.close();
                    toastr.error('something went wrong');
                });
        },
        update_class(id) {
            if (this.update_selected_teacher == '' || this.level.name == '') {
                swal.fire('oops', 'some fields are empty', 'error');
            } else {
                swal.fire({
                    text: 'Please wait...',
                    allowOutsideClick: false
                });
                swal.showLoading();

                let fd = new FormData;
                fd.append('name', this.level.name);
                if (Number.isInteger(this.update_selected_teacher)) {
                    fd.append('teacher_id', this.update_selected_teacher);
                }

                axios.post(`${url.update_single_class + id}`, fd, config)
                    .then((response) => {
                        console.log(response);
                        swal.fire('weldon', response.data.success, 'success');
                        $('.update_class').modal('hide');
                    })
                    .catch((error) => {
                        console.log(error);
                        toastr.error('something went wrong');
                    })
                    .then(() => {
                        this.get_items();
                        swal.close();
                    });
            }
        },
        pageChange(page) {
            if (this.page != page && page != 0) {
                this.page = page;
                this.get_items();
            }
        },
        showContent() {
            this.loading = false;
            this.content = true;
        },
    },
});
