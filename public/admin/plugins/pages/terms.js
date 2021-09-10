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

                axio
            }
        },
        showContent() {
            this.loading = false;
            this.content = true;
        },
    },
})
