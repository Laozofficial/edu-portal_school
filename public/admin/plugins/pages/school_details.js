new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,
        institution: {}
    },
    mounted() {
        this.get_school_details();
    },
    methods: {
        get_school_details() {
            axios.get(`${url.get_school_details + id}`, config)
                .then((response) => {
                    console.log(response);
                    this.institution = response.data.institution;
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
    },
})
