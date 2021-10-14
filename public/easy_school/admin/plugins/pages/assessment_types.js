Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        institutions: [],
        selected_institution: '',

        assessment_types: [],
        assessment_type: {},

        max_mark: '',
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
        showContent() {
            this.loading = false;
            this.content = true;
        },
        get_assessment_types() {
            swal.fire({
                text: 'Please wait...',
                allowOutsideClick: false
            });
            swal.showLoading();

            axios.get(`${url.get_assessment_types + this.selected_institution}`, config)
                .then((response) => {
                    console.log(response);
                    swal.close();
                    this.assessment_types = response.data.assessment_types;
                })
                .catch((error) => {
                    console.log(error);
                    swal.close();
                    toastr.error('something went wrong');
                });
        },
        update_type(id) {
            swal.fire({
                text: 'Please wait...',
                allowOutsideClick: false
            });
            swal.showLoading();

            axios.get(`${url.get_single_assessment + id}`, config)
                .then((response) => {
                    console.log(response);
                    swal.close();
                    this.assessment_type = response.data.assessment_type;
                    $('.update_assessment').modal('show');
                })
                .catch((error) => {
                    swal.close();
                    console.log(error);
                    toastr.error('something went wrong');
                })
        },
        save_assessment_type() {
            if (this.name == '' || this.max_mark == '' || this.selected_institution == '') {
                swal.fire('oops', 'Some fields are empty, Please dont forget to select an institution', 'error');
            } else {
                swal.fire({
                    text: 'Please wait...',
                    allowOutsideClick: false
                });
                swal.showLoading();

                let fd = new FormData;
                fd.append('name', this.name);
                fd.append('max_mark', this.max_mark);

                axios.post(`${url.save_assessment_type + this.selected_institution}`, fd, config)
                    .then((response) => {
                        console.log(response);
                        swal.close();
                        swal.fire('weldon', response.data.success, 'success');
                        this.get_assessment_types();
                    })
                    .catch((error) => {
                        console.log(error);
                        swal.close();
                        if (error.response.data.error) {
                            swal.fire('Oops', error.response.data.error, 'error');
                        }
                        toastr.error('something went wrong');
                    });
            }
        },
        save_update_assessment(id) {
            if (this.assessment_type.name == '' || this.assessment_type.max_mark == '') {
                swal.fire('oops', 'some fields are missing', 'error')
            } else {
                swal.fire({
                    text: 'Please wait...',
                    allowOutsideClick: false
                });
                swal.showLoading();

                let fd = new FormData;
                fd.append('name', this.assessment_type.name);
                fd.append('max_mark', this.assessment_type.max_mark);

                axios.post(`${url.update_single_assessment_type + id}`, fd, config)
                    .then((response) => {
                        console.log(response);
                        swal.close();
                        $('.update_assessment').modal('hide');
                    })
                    .catch((error) => {
                        console.log(error);
                        swal.close();
                        toastr.error('something went wrong');
                    })
                    .then(() => {
                        this.get_assessment_types();
                    });
            }
        }

    },
});
