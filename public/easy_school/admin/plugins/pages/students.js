Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        institutions: [],
        selected_institution: '',

        students: [],
        loading_students: true,
        page: 1,

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
        get_students() {
             swal.fire({
                 text: 'Please wait...',
                 allowOutsideClick: false
             });
             swal.showLoading();

            axios.get(`${url.get_students + this.selected_institution}`, config)
                .then((response) => {
                    console.log(response);
                    this.students = response.data.students;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error('something went wrong');
                })
                .then(() => {
                    swal.close();
                });
        },
        pageChange(page) {
            if (this.page != page && page != 0) {
                this.page = page;
                this.get_students();
            }
        },
        showContent() {
            this.loading = false;
            this.content = true;
        }
    },
})
