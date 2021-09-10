Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        institutions: [],
        selected_institution: '',

        sessions: [],
        selected_session: '',

        update_selected_session: '',

        terms: [],
        term: {},

        name: '',
        start_date: '',
        end_date: '',
        status: ''
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
        get_sessions() {
            swal.fire({
                text: 'Please wait...',
                allowOutsideClick: false
            });
            swal.showLoading();

            axios.get(`${url.get_session + this.selected_institution}`, config)
                .then((response) => {
                    console.log(response);
                    swal.close();
                    this.sessions = response.data.sessions;
                    if (this.sessions.length < 1) {
                        this.error = 'No Sessions has been Created Yet';
                        this.errors_switch = true;
                    }
                })
                .catch((error) => {
                    console.log(console.error());
                    toastr.error('something went wrong');
                })
                .then(() => {
                    this.get_terms();
                });
        },
        save_term() {
            if (this.name == '' || this.selected_institution == '' || this.selected_session == '' || this.status == '' || this.start_date == '' || this.end_date == '') {
                swal.fire('Oops..', 'some fields are empty', 'error');
            } else {
                swal.fire({
                    text: 'Please wait...',
                    allowOutsideClick: false
                });
                swal.showLoading();

                let fd = new FormData;
                fd.append('name', this.name);
                fd.append('academic_year_id', this.selected_session);
                fd.append('institution_id', this.selected_institution);
                fd.append('start_date', this.start_date);
                fd.append('end_date', this.end_date);
                fd.append('status', this.status);

                axios.post(`${url.save_terms}`, fd, config)
                    .then((response) => {
                        console.log(response);
                        swal.close();
                        swal.fire('weldon', response.data.success, 'success');
                    })
                    .catch((error) => {
                        console.log(error);
                        if (error.response.data.error) {
                            swal.fire('Oops...', error.response.data.error, 'error');
                        }
                        toastr.error('something went wrong');
                    })
                    .then(() => {
                        this.get_terms();
                    });
            }
        },
        get_terms() {
            axios.get(`${url.get_terms + this.selected_institution}`, config)
                .then((response) => {
                    console.log(response);
                    this.terms = response.data.terms;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error('something went wrong');
                });
        },
        update_term(id) {
            swal.fire({
                text: 'Please wait...',
                allowOutsideClick: false
            });
            swal.showLoading();

            axios.get(`${url.get_single_term + id}`, config)
                .then((response) => {
                    console.log(response);
                    swal.close();
                    this.term = response.data.term;
                    $('#update_term').modal('show');
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error('something went wrong');
                })
                .then(() => {
                    swal.close();
                });
        },
        save_update_term(id) {
            swal.fire({
                text: 'Please wait...',
                allowOutsideClick: false
            });
            swal.showLoading();

            let fd = new FormData;
            fd.append('name', this.term.name);
            fd.append('start_date', this.term.start_date);
            fd.append('end_date', this.term.end_date);
            fd.append('status', this.term.status);

            axios.post(`${url.save_updated_term + id}`, fd, config)
                .then((response) => {
                    console.log(response);
                    swal.close();
                    swal.fire('weldon', response.data.success, 'success');
                    $('#update_term').modal('hide');
                    this.get_terms();
                })
                .catch((error) => {
                    console.log(error);
                    swal.close();
                    toastr.error('something went wrong');
                });
        },
        showContent() {
            this.loading = false;
            this.content = true;
        },
    },
})
