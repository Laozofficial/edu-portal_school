Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        institutions: JSON.parse(window.localStorage.getItem('schools')),
        selected_institution: '',
        new_leave_type_institution: '',

        leave_types: [],
        leave_type: {},

        loading_leave_type: false,

        page: 1,

        total_days: '',
        name: '',
    },
    mounted() {
        if (this.institutions.length > 0) {
            showContentView();
        }
    },
    methods: {
        get_leave_types() {
            swal.fire('Please wait....');
            swal.showLoading();

            axios.get(`${url.get_leave_types + this.selected_institution}`, config)
                .then((response) => {
                    console.log(response);
                    this.leave_types = response.data.leave_types;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`${server_error}`);
                })
                .then(() => {
                    swal.close();
                });
        },
        get_single_leave_type(type) { //pass the entire object as a parameter
            this.leave_type = type;
            $('#leave_type_detail').modal('show');
        },
        pageChange(page) {
            if (this.page != page && page != 0) {
                this.page = page;
                this.get_leave_types();
            }
        },
        save_update(id) {
            if (this.leave_type.name == '' || this.leave_type.total_days == '') {
                swal.fire('Oops', 'some fields are missing', 'error');
            } else {
                swal.fire('Please wait....');
                swal.showLoading();

                let fd = new FormData;
                fd.append('name', this.leave_type.name);
                fd.append('total_days', this.leave_type.total_days);

                axios.post(`${url.save_leave_type_update + id}`, fd, config)
                    .then((response) => {
                        console.log(response);
                        swal.fire('Weldon', response.data.success, 'success');
                        $('#leave_type_detail').modal('hide');
                    })
                    .catch((error) => {
                        console.log(error);
                        toastr.error(`${server_error}`);
                    })
                    .then(() => {
                        swal.close();
                        this.get_leave_types();
                    })
            }
        },
        save_leave_type() {
            if (this.selected_institution == '' || this.name == '' || this.total_days == '') {
                swal.fire('Oops', 'some fields are empty', 'error');
            } else {
                swal.fire('Please wait....');
                swal.showLoading();

                let fd = new FormData;
                fd.append('name', this.name);
                fd.append('total_days', this.total_days);
                fd.append('institution_id', this.selected_institution);

                axios.post(`${url.save_leave_type}`, fd, config)
                    .then((response) => {
                        console.log(response);
                        swal.fire('Weldon', response.data.success, 'success');
                    })
                    .catch((error) => {
                        console.log(error);
                        toastr.error(`${server_error}`);
                    })
                    .then(() => {
                        this.get_leave_types();
                    });
            }
        }
    }
});
