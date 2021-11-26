Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        institutions: JSON.parse(window.localStorage.getItem('schools')),
        selected_institution: '',

        loading_materials: false,

        materials: [],

        page: 1

    },
    mounted() {
        if (this.institutions.length > 0) showContentView();
    },
    methods: {
        get_study_materials() {
            this.loading_materials = true;
            swal.fire('Please wait....');
            swal.showLoading();

            axios.get(`${url.get_study_materials + this.selected_institution + '?page=' + this.page}`, config)
                .then((response) => {
                    console.log(response);
                    this.materials = response.data.materials;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`${server_error}`);
                })
                .then(() => {
                    this.loading_materials = false;
                    swal.close();
                })
        },
        pageChange(page) {
            if (this.page != page && page != 0) {
                this.page = page;
                this.get_study_materials();
            }
        },
    },
})
