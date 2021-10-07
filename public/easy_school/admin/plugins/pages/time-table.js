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

        levels: [],
        selected_level: '',

        terms: [],
        selected_term: '',

        time_table: '',

        time_tables: [],

        filter_selected_level: '',
        filter_selected_term: '',
        filter_selected_session: '',

        errors: [],
        errors_switch: false,

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
        get_other_details() {
            this.filter_time_table();
            swal.fire('please wait ....');
            swal.showLoading();

            axios.get(`${url.get_other_details + this.selected_institution}`, config)
                .then((response) => {
                    console.log(response);
                    this.sessions = response.data.sessions;
                    this.levels = response.data.levels;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`something went wrong ${error.response.status}`);
                })
                .then(() => {
                    swal.close();
                });
        },
        get_terms() {
            swal.fire('please wait ....');
            swal.showLoading();

            axios.get(`${url.get_terms_from_academic_session + this.selected_session}`, config)
                .then((response) => {
                    console.log(response);
                    this.terms = response.data.terms;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`something went wrong ${error.response.status}`);
                })
                .then(() => {
                    swal.close();
                });
        },
        onTimeTableChange(event) {
            this.time_table = event.target.files[0];
        },
        save_time_table() {
            if (this.selected_institution == '') {
                swal.fire('Oops', 'Please Select an Institution', 'error');
            } else {
                if (this.selected_level == '' || this.selected_session == '' || this.selected_term == '') {
                    swal.fire('Oops', 'some fields are empty', 'error');
                } else {
                    swal.fire({
                        text: 'Please wait...',
                        allowOutsideClick: false
                    });
                    swal.showLoading();

                    let fd = new FormData;
                    fd.append('institution_id', this.selected_institution);
                    fd.append('session', this.selected_session);
                    fd.append('level', this.selected_level);
                    fd.append('term', this.selected_term);
                    fd.append('time_table', this.time_table);

                    axios.post(`${url.save_time_table}`, fd, config)
                        .then((response) => {
                            console.log(response);
                            swal.fire('Weldon', response.data.success, 'success');
                            this.filter_time_table();
                        })
                        .catch((error) => {
                            swal.close();
                            console.log(error);
                            this.errors = error.response.data.errors;
                            this.errors_switch = true;
                            toastr.error(`something went wrong ${error.response.status}`);
                        });
                }
            }
        },
        filter_time_table() {
            swal.fire('Please wait..');
            swal.showLoading();

            let fd = new FormData;
            fd.append('session', this.filter_selected_session);
            fd.append('level', this.filter_selected_level);
            fd.append('term', this.filter_selected_term);

            axios.post(`${url.get_time_tables + this.selected_institution}`, fd, config)
                .then((response) => {
                    console.log(response);
                    this.time_tables = response.data.time_tables;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`something went wrong ${error.response.status}`);
                })
                .then(() => {
                    swal.close();
                });
        },
        showContent() {
            this.loading = false;
            this.content = true;
        },
        edit_time_table() {

        },
        delete_time_table(id) {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this file!",
                    type: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal('please wait ....');
                        swal.showLoading();

                        axios.get(`${url.delete_time_table + id}`, config)
                            .then((response) => {
                                console.log(response);
                                swal.close();
                                swal('Weldon', response.data.success, 'success');
                                this.filter_time_table();
                            })
                            .catch((error) => {
                                console.log(error);
                                toastr.error(`something went wrong, ${response.data.status}`);
                            });
                    }
                });
        },
    },
    watch: {
        errors_switch: function () {
            setTimeout(() => {
                this.errors_switch = false;
            }, 10000);
        }
    },
});
