Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        levels: [],
        selected_level: '',
        new_selected_class: '',

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

        }
    }
});
