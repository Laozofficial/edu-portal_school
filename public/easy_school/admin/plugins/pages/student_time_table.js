new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,
        time_table: []
    },
    mounted() {
        this.get_time_table();
    },
    methods: {
        get_time_table() {
            axios.get(`${url.student_get_time_table}`, config)
                .then((response) => {
                    console.log(response);
                    this.time_table = response.data.time_tables;
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
