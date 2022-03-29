Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        institutions: JSON.parse(window.localStorage.getItem('schools')),
        selected_institution: '',

        sessions: [],
        selected_session: '',

        total_days: 0,

        terms: [],
        selected_term: '',

        attendance_setups: [],

        single_attendance: {}
    },
    mounted() {
        this.showContent();
    },
    methods: {
        get_sessions() {
            this.get_attendance_setups();
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
        showContent() {
            this.loading = false;
            this.content = true;
        },
        save_attendance_setup() {
            if (this.selected_institution == '' || this.selected_session == '' || this.total_days < 1 || this.selected_term == '') {
                swal.fire('error', 'some fields are empty', 'error');
                return;
            }

            swal.fire('saving...');
            swal.showLoading();

            let fd = new FormData;
            fd.append('institution', this.selected_institution);
            fd.append('session', this.selected_session);
            fd.append('total_days', this.total_days);
            fd.append('term', this.selected_term);

            axios.post(`${url.save_attendance_setup}`, fd, config)
                .then((response) => {
                    console.log(response);
                    swal.fire('success', response.data.success, 'success');
                })
                .catch((error) => {
                    console.log(error);
                    if (error.response.data.error) {
                        swal.fire('error', error.response.data.error, 'error');
                        return;
                    }
                    toastr.error('something went wrong');
                })
                .then(() => {
                    setTimeout(() => {
                        swal.close();
                    }, 3000);
                    this.get_attendance_setups();
                });
        },
        get_terms() {
            swal.fire('getting terms....');
            swal.showLoading();

            axios.get(`${url.get_terms_by_session + this.selected_session}`, config)
                .then((response) => {
                    console.log(response);
                    this.terms = response.data.terms;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error('something went wrong with getting the terms');
                })
                .then(() => {
                    swal.close();
                });
        },
        get_attendance_setups() {
            swal.fire('getting attendance setups....');
            swal.showLoading();

            axios.get(`${url.get_attendance_setups + this.selected_institution}`, config)
                .then((response) => {
                    console.log(response);
                    this.attendance_setups = response.data.attendance_setups;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error('something went wrong with getting the attendance setups');
                })
                .then(() => {
                    swal.close();
                });
        },
        edit_attendance_setup(attendance) {
            this.single_attendance = attendance;
            $('#edit_attendance_setup').modal('show');
        },
        save_update() {
            if (this.single_attendance.total_days == '' || this.single_attendance < 1) {
                swal.fire('error', 'field cannot be empty and must be greater than 0', 'error');
                return;
            }

            let fd = new FormData;
            fd.append('total_days', this.single_attendance.total_days);

            axios.post(`${url.update_attendance_setup + this.single_attendance.id}`, fd, config)
                .then((response) => {
                    console.log(response);
                    $('#edit_attendance_setup').modal('hide');
                    swal.fire('success', response.data.success, 'success');
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error('something went wrong');
                })
                .then(() => {
                    this.get_attendance_setups();
                    setTimeout(() => {
                        swal.close();
                    }, 2500);
                });
        }
    },
})
