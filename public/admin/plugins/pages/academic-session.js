Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,
        institutions: [],
        institution: {},
        selected_institution: '',
        end_date: '',
        start_date: '',
        sessions: [],

        error: '',
        errors_switch: false
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

            axios.post(`${url.get_session + this.selected_institution}`, config)
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
        save_session() {
            swal.fire({
                text: 'Please wait...',
                allowOutsideClick: false
            });
            swal.showLoading();

            let fd = new FormData;
            fd.append('start_date', this.start_date);
            fd.append('end_start', this.end_start);

            axios.post(`${url.save_session + this.selected_institution}`, config)
                .then((response) => {
                    console.log(response);
                    swal.fire('weldon', response.data.success, 'success');
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error('something went wrong');
                });

        },
        showContent() {
            this.loading = false;
            this.content = true;
        },
    },
})
