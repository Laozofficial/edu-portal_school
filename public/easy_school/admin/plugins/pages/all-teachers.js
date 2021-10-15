Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,
        loading_teachers: false,

        institutions: [],
        selected_institution: '',

        teachers: [],
        page: 1,


        teacher: {
            country: {},
            state: {},
            full_name_text: '',
            user:{}
        }
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
        showContent() {
            this.loading = false;
            this.content = true;
        },
        get_teachers() {
            this.loading_teachers = true;
            // handling pagination , i know , pagination in vue is a bitch lol 🙂
            axios.get(`${url.get_teachers + this.selected_institution + '?page=' + this.page}`, config)
                .then((response) => {
                    console.log(response);
                    this.teachers = response.data.teachers;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error('something went wrong');
                })
                .then(() => {
                    this.loading_teachers = false;
                });
        },
        pageChange(page) {
            if (this.page != page && page != 0) {
                this.page = page;
                this.get_teachers();
            }
        },
        view(slug) {
             swal.fire({
                 text: 'Please wait...',
                 allowOutsideClick: false
             });
            swal.showLoading();

            axios.get(`${url.get_single_teacher + slug}`, config)
                .then((response) => {
                    console.log(response);
                    swal.close();
                    this.teacher = response.data.teacher;
                    $('.teacher-details-lg').modal('show');
                })
                .catch((error) => {
                    console.log(error);
                    swal.close();
                    toastr.error('something went wrong');
                });
        },
        update(slug) {
            window.location.href = '/dashboard/admin/update-teacher/' + slug;
        },
        ban_teacher(id) {
            swal({
                    title: "Are you sure?",
                    text: "Once banned, The Teacher won'\t be able to login anymore!",
                    type: "warning",
                    showConfirmButton: true,
                    cancelButtonText: "Cancel",
                    showCancelButton: true,
                })
                .then((isConfirmed) => {
                    console.log(isConfirmed.dismiss)
                    if (isConfirmed.dismiss == 'cancel' || isConfirmed.dismiss == 'overlay') {
                        console.log('do nothing')
                    } else {
                        swal('please wait ....');
                        swal.showLoading();

                        axios.get(`${url.ban_teacher + id}`, config)
                            .then((response) => {
                                console.log(response);
                                swal.close();
                                swal('Weldon', response.data.success, 'success');
                                this.get_teachers();
                            })
                            .catch((error) => {
                                console.log(error);
                                swal.close();
                                toastr.error(`something went wrong, ${response.data.status}`);
                            });
                    }
                });
        },
        activate_teacher(id) {
            swal({
                    title: "Are you sure?",
                    text: "Once activated, The Teacher will be able to access their portal",
                    type: "warning",
                    showConfirmButton: true,
                    cancelButtonText: "Cancel",
                    showCancelButton: true,
                })
                .then((isConfirmed) => {
                    console.log(isConfirmed.dismiss)
                    if (isConfirmed.dismiss == 'cancel' || isConfirmed.dismiss == 'overlay') {
                        console.log('do nothing')
                    } else {
                        swal('please wait ....');
                        swal.showLoading();

                        axios.get(`${url.activate_teacher + id}`, config)
                            .then((response) => {
                                console.log(response);
                                swal.close();
                                swal('Weldon', response.data.success, 'success');
                                this.get_teachers();
                            })
                            .catch((error) => {
                                console.log(error);
                                swal.close();
                                toastr.error(`something went wrong, ${response.data.status}`);
                            });
                    }
                });
        }

    },
});
