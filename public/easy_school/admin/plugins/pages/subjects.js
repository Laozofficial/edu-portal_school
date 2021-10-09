Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el:'#app',
    data: {
        loading: true,
        content: false,

        institutions: [],
        selected_institution: '',

        levels: [],
        selected_level: '',

        subjects: [],

        name: '',
        subject_code: '',
        label: '',

        page: 1,
        loading_subjects: false,

        subject: {},
        level: '',
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
        get_all_classes() {
            axios.get(`${url.get_classes + this.selected_institution}`, config)
                .then((response) => {
                    console.log(response);
                    this.levels = response.data.levels;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`something went wrong ${error.response.status}`);
                })
        },
        get_subjects() {
            this.loading_subjects = true;
            swal.fire({
                text: 'Please wait...',
                allowOutsideClick: false
            });
            swal.showLoading();

            axios.get(`${url.get_subjects + this.selected_institution + '?page=' + this.page}`, config)
                .then((response) => {
                    console.log(response);
                    swal.close();
                    this.subjects = response.data.subjects;
                })
                .catch((error) => {
                    console.log(error);
                    swal.close();
                    toastr.error('something went wrong');
                })
                .then(() => {
                    swal.close();
                    this.get_all_classes();
                });
        },
        save_subject() {
            if (this.name == '' || this.subject_code == '' || this.selected_institution == '' ||this.label == '' || this.selected_level == '') {
                swal.fire('oops', institution_and_empty_field_error, 'error');
            } else {
                swal.fire({
                    text: 'Please wait...',
                    allowOutsideClick: false
                });
                swal.showLoading();

                let fd = new FormData;
                fd.append('institution_id', this.selected_institution);
                fd.append('name', this.name);
                fd.append('subject_code', this.subject_code);
                fd.append('label', this.label);
                fd.append('level', this.selected_level);

                axios.post(`${url.save_subject + this.selected_institution}`, fd, config)
                    .then((response) => {
                        console.log(response);
                        swal.close();
                        swal.fire('weldon', response.data.success, 'success');
                        this.get_subjects();
                    })
                    .catch((error) => {
                        console.log(error);
                        swal.close();
                        toastr.error('something went wrong');
                    })
                    .then(() => {
                        swal.close();
                        this.loading_subjects = false;
                    });
            }
        },
        pageChange(page) {
            if (this.page != page && page != 0) {
                this.page = page;
                this.get_subjects();
            }
        },
        update_subject(id) {
            swal.fire({
                text: 'Please wait...',
                allowOutsideClick: false
            });
            swal.showLoading();

            axios.get(`${url.get_single_subject + id}`, config)
                .then((response) => {
                    console.log(response);
                    swal.close();
                    this.subject = response.data.subject;
                    $('.update_subject').modal('show');
                })
                .catch((error) => {
                    console.log(error);
                    swal.close();
                    toast.error('something went wrong');
                });
        },
        save_update_changes(id) {
            if (this.subject.subject_code == '' || this.subject.name == '' || this.label == '') {
                swal.fire('Oops', 'Subject name or subject code field cannot be empty', 'error');
            } else {
                swal.fire({
                    text: 'Please wait...',
                    allowOutsideClick: false
                });
                swal.showLoading();

                let fd = new FormData;
                fd.append('name', this.subject.name);
                fd.append('subject_code', this.subject.subject_code);
                fd.append('level', this.selected_level);
                if (isNaN(this.selected_level)) {
                } else {
                    fd.append('label', this.subject.label);
                }

                axios.post(`${url.save_subject_update + id}`, fd, config)
                    .then((response) => {
                        console.log(response);
                        swal.close();
                        swal.fire('Weldon', response.data.success, 'success');
                        $('.update_subject').modal('hide');
                        this.get_subjects();
                    })
                    .catch((error) => {
                        console.log(error);
                        swal.close();
                        toastr.error('something went wrong');
                    });
            }
        },
        showContent() {
            this.loading = false;
            this.content = true;
        }
    },
})
