Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        institutions: [],
        selected_institution: '',

        classes: [],
        selected_classes: '',

        teachers: [],
        selected_teacher: '',

        name: '',
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
            swal.fire({
                text: 'Please wait...',
                allowOutsideClick: false
            });
            swal.showLoading();

            axios.get(`${url.get_classes_and_teachers + this.selected_institution}`, config)
                .then((response) => {
                    console.log(response);
                    swal.close();
                    this.classes = response.data.classes;
                    this.teachers = response.data.teachers;
                })
                .catch((error) => {
                    console.log(error);
                    swal.fire('Oops', error.response.data.error, 'error');
                    this.classes = error.response.data.classes;
                    this.teachers = error.response.data.teachers;
                    toastr.error('something went wrong');
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
        showContent() {
            this.loading = false;
            this.content = true;
        },
    },
});
