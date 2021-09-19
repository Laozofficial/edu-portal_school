new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,
        institutions: []
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
        view(slug) {
            window.location.href = '/dashboard/admin/school-details/' + slug;
        },
        update(slug) {
            window.location.href = '/dashboard/admin/school-update/' + slug;
        }
    },
})
