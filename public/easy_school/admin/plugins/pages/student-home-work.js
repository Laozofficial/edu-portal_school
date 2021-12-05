new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        assignments:[]
    },
    mounted() {
        this.get_home_works();
    },
    methods: {
        get_home_works() {
            axios.get(`${url.student_get_home_work}`, config)
                .then((response) => {
                    console.log(response);
                    this.assignments = response.data.assignments;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error('something went wrong');
                })
                .then(() => {
                    showContentView();
                });
        }
    },
})
