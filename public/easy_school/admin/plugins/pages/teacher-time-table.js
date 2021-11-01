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
        // this.get_schools();
        this.get_other_details();
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
                // this.filter_time_table();
                swal.fire('please wait ....');
                swal.showLoading();

                axios.get(`${url.teacher_get_other_details}`, config)
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
                        this.showContent();
                        swal.close();
                    });
            },
            get_terms() {
                swal.fire('please wait ....');
                swal.showLoading();

                axios.get(`${url.teacher_get_terms_from_academic_session + this.selected_session}`, config)
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
            filter_time_table() {
                swal.fire('Please wait..');
                swal.showLoading();

                let fd = new FormData;
                fd.append('session', this.filter_selected_session);
                fd.append('level', this.filter_selected_level);
                fd.append('term', this.filter_selected_term);

                axios.post(`${url.teacher_get_time_tables}`, fd, config)
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
    }
})
