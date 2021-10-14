Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        institutions: [],
        selected_institution: '',

        parents: []
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
        get_parents() {
            swal.fire('Please wait...');
            swal.showLoading();

            axios.get(`${url.get_all_parents + this.selected_institution}`, config)
                .then((response) => {
                    console.log(response);
                    swal.close();
                    this.parents = response.data.parents;
                })
                .catch((error) => {
                    console.log(error);
                    swal.close();
                    toastr.error(`something went wrong ${error.response.status}`);
                });
        }
    }
});
