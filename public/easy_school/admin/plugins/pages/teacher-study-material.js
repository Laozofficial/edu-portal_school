Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        levels: [
            {
                id: '',
                name: ''
            }
        ],
        selected_level: '',

        classes: [],
        selected_class: '',

        subjects: [],
        selected_subject: '',

        sessions: [],
        selected_session: '',

        title: '',
        material: '',
        description: '',

        page: 1,
        loading_materials: false,

        materials: []
    },
    mounted() {
        $(".summernote").summernote({
            height: 190,
            minHeight: null,
            maxHeight: null,
            focus: !1
        }),
        this.get_classes();
        this.get_materials();
    },
    methods: {
        get_classes() {
            axios.get(`${url.teacher_get_other_details}`, config)
                .then((response) => {
                    console.log(response);
                    this.levels = response.data.levels;
                    this.classes = response.data.classes;
                    this.sessions = response.data.sessions;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`something went wrong ${error.response.status}`);
                })
                .then(() => {
                    showContentView();
                });
        },
        get_subjects() {
            swal.fire('Please wait..');
            swal.showLoading();

            axios.get(`${url.teacher_get_subjects + this.selected_level}`, config)
                .then((response) => {
                    console.log(response);
                    this.subjects = response.data.subjects;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`${server_error} ${error.response.status}`);
                })
                .then(() => {
                    swal.close();
                });
        },
        get_materials() {
            this.loading_materials = true;

            axios.get(`${url.teacher_get_materials + '?page=' + this.page}`, config)
                .then((response) => {
                    console.log(response);
                    this.materials = response.data.materials;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`${server_error} ${error.response.status}`);
                })
                .then(() => {
                    this.loading_materials = false;
                });
        },
        pageChange(page) {
            if (this.page != page && page != 0) {
                this.page = page;
                this.get_materials();
            }
        },
        onMaterialChange(event) {
             this.material = event.target.files[0];
        },
        save_material() {
            // get summernote values
            this.description = $('.summernote').val();
            if (this.selected_level == '' || this.selected_session == '' || this.selected_subject == '' || this.title == '' || this.material == '' || this.description == '')
            {
                swal.fire('Oops', 'some fields are missing', 'error');
            } else {
                swal.fire('Please wait.....');
                swal.showLoading();

                let fd = new FormData;
                fd.append('level_id', this.selected_level);
                fd.append('session_id', this.selected_session);
                fd.append('subject_id', this.selected_subject);
                fd.append('title', this.title);
                fd.append('material', this.material);
                fd.append('description', this.description);

                axios.post(`${url.teacher_save_material}`, fd, config)
                    .then((response) => {
                        console.log(response);
                        swal.fire('weldon', response.data.success, 'success');
                    })
                    .catch((error) => {
                        console.log(error);
                        toastr.error(`${server_error} ${error.response.status}`);
                    })
                    .then(() => {
                        this.get_materials();
                    });
            }
        },
        delete_material(id) {
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

                        axios.get(`${url.teacher_delete_material + id}`, config)
                            .then((response) => {
                                console.log(response);
                                swal.close();
                                swal('Weldon', response.data.success, 'success');
                                this.get_materials();
                            })
                            .catch((error) => {
                                console.log(error);
                                toastr.error(`something went wrong, ${response.data.status}`);
                            });
                    }
                });
        },
    }
});
