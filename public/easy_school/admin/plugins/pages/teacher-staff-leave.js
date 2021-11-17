Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        sessions: [],
        selected_session: '',

        leave_types: [],
        selected_leave_type: '',

        leave_letter: '',
        leave_start_date: '',
        leave_end_date: '',
        leave_reason: '',

        leaves: [],
        page: 1,
        loading_leaves: false,

        errors: [],
        show_errors: false
    },
    mounted() {
        $(".summernote").summernote({
            height: 190,
            minHeight: null,
            maxHeight: null,
            focus: !1
        }),
        this.get_details_for_leave();
        this.get_leaves();
    },
    methods: {
        get_details_for_leave() {
            axios.get(`${url.teacher_details_for_leave}`, config)
                .then((response) => {
                    console.log(response);
                    this.sessions = response.data.sessions;
                    this.leave_types = response.data.leave_types;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`${server_error} ${error.response.status}`);
                })
                .then(() => {
                    showContentView();
                });
        },
        onLeaveLetterChange(event) {
            this.leave_letter = event.target.files[0];
        },
        get_leaves() {
            this.loading_leaves = true;
            axios.get(`${url.teacher_get_leave_application + '?page=' + this.page}`, config)
                .then((response) => {
                    console.log(response);
                    this.leaves = response.data.leaves;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`${server_error} ${error.response.status}`);
                })
                .then(() => {
                    this.loading_leaves = false;
                });
        },
        pageChange(page) {
            if (this.page != page && page != 0) {
                this.page = page;
                this.get_leaves();
            }
        },
        apply_for_leave() {
            this.leave_reason = $('.summernote').val();
            if (this.selected_leave_type == '' || this.selected_session == '' || this.leave_letter == '' || this.leave_start_date == '' || this.leave_end_date == '') {
                swal.fire('Oops', 'some fields are empty', 'error');
            } else {
                swal.fire('Please wait....', 'error');
                swal.showLoading();

                let fd = new FormData;
                fd.append('leave_type', this.selected_leave_type);
                fd.append('session', this.selected_session);
                fd.append('leave_letter', this.leave_letter);
                fd.append('leave_start_date', this.leave_start_date);
                fd.append('leave_end_date', this.leave_end_date);
                fd.append('leave_reason', this.leave_reason);

                axios.post(`${url.teacher_apply_leave}`, fd, config)
                    .then((response) => {
                        console.log(response);
                        swal.fire('Weldon', response.data.success, 'success');
                    })
                    .catch((error) => {
                        console.log(error);
                        if (error.response.data.errors) this.errors = error.response.data.errors; this.show_errors = true;
                        toastr.error(`${server_error} ${error.response.status}`);
                    })
                    .then(() => {
                        this.get_leaves();
                        swal.close();
                    });
            }
        },
        delete_leave(id) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this file!",
                type: "warning",
                showConfirmButton: true,
                cancelButtonText: "Cancel",
                showCancelButton: true,
            })
            .then((isConfirmed) => {
                console.log(isConfirmed.dismiss)
                if (isConfirmed.dismiss == 'cancel' || isConfirmed.dismiss == 'overlay') {
                    console.log('do nothing');
                } else {
                    swal('please wait ....');
                    swal.showLoading();

                    axios.get(`${url.teacher_delete_application + id}`, config)
                        .then((response) => {
                            console.log(response);
                            swal.close();
                            swal('Weldon', response.data.success, 'success');
                            this.get_leaves();
                        })
                        .catch((error) => {
                            console.log(error);
                            if(error.response.data.errors) this.errors = error.response.data.errors; this.show_errors = true;
                            toastr.error(`something went wrong, ${response.data.status}`);
                        });
                }
            });
        }
    },
})
