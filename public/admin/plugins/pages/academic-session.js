Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        institutions: [],
        institution: {},
        selected_institution: '',

        name: '',
        end_date: '',
        start_date: '',
        status: '',

        sessions: [],
        session: {},

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
        save_session() {
            if (this.selected_institution == '' || this.start_date == '' || this.end_date == '') {
                swal.fire('Oops..', 'Some fields are empty, Please make sure you select an institution on the top right of your screen', 'error');
            }else {
                swal.fire({
                    text: 'Please wait...',
                    allowOutsideClick: false
                });
                swal.showLoading();

                let fd = new FormData;
                fd.append('name', this.name);
                fd.append('start_date', this.start_date);
                fd.append('end_date', this.end_date);
                fd.append('status', this.status);

                axios.post(`${url.save_session + this.selected_institution}`,fd, config)
                    .then((response) => {
                        console.log(response);
                        this.get_sessions();
                        swal.fire('weldon', response.data.success, 'success');
                    })
                    .catch((error) => {
                        console.log(error);
                        toastr.error('something went wrong');
                    });
            }
        },
        update_session(id) {
            swal.fire('Loading session....');
            swal.showLoading();

            axios.get(`${url.get_single_session + id}`, config)
                .then((response) => {
                    console.log(response);
                    this.session = response.data.session;
                    $('#update_session').modal('show');
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error('something went wrong');
                })
                .then(() => {
                    swal.close();
                });
        },
        save_update_session(id) {
            swal.fire({
                text: 'Please wait...',
                allowOutsideClick: false
            });
            swal.showLoading();

            let fd = new FormData;
            fd.append('name', this.session.name);
            fd.append('start_date', this.session.start_date);
            fd.append('end_date', this.session.end_date);
            fd.append('status', this.session.status);

            axios.post(`${url.save_update_session + id}`, fd , config)
                .then((response) => {
                    console.log(response);
                    swal.close();
                    swal.fire('weldon', response.data.success, 'success');
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error('something went wrong');
                })
        },
        showContent() {
            this.loading = false;
            this.content = true;
        },
    },
})
