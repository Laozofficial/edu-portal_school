Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        institutions: [],
        selected_institution: '',

        leaves: [],

        page: 1,
        loading_applications: false,

        application: {},

        update_leave_status: ''

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
                    showContentView();
                });
        },
        get_leave_applications() {
            this.loading_applications = true;

            axios.get(`${url.teacher_leave_applications + this.selected_institution + '?page=' + this.page}`, config)
                .then((response) => {
                    console.log(response);
                    this.leaves = response.data.leaves;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`${server_error}`);
                })
                .then(() => {
                    this.loading_applications = false;
                });
        },
        pageChange(page) {
            if (this.page != page && page != 0) {
                this.page = page;
                this.get_leave_applications();
            }
        },
        leave_details(id) {
            swal.fire('Please wait....');
            swal.showLoading();

            axios.get(`${url.get_leave_details + id}`, config)
                .then((response) => {
                    console.log(response);
                    this.application = response.data.application;
                    $('#leave_details').modal('show');
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`${server_error} ${error.response.status}`);
                })
                .then(() => {
                    swal.close();
                });
        },
        approve_leave(id) {

        },
        update_application() {
            if (this.update_leave_status == '' || this.application.end_leave_date == '') {
                swal.fire('Oops', 'some fields are empty', 'error');
            } else {
                swal.fire('Please wait....');
                swal.showLoading();

                let fd = new FormData;
                fd.append('status', this.update_leave_status);
                if (this.update_leave_status == '2') fd.append('return_date', this.application.end_leave_date);

                axios.post(`${url.save_leave_response + this.application.id}`, fd, config)
                    .then((response) => {
                        console.log(response);
                        swal.fire('Weldon', response.data.success, 'success');
                         $('#leave_details').modal('hide');
                    })
                    .catch((error) => {
                        console.log(error);
                        toastr.error(`${server_error} ${error.response.status}`);
                    })
                    .then(() => {
                        swal.close();
                        this.get_leave_applications();
                    });
            }
        }
    },
})
