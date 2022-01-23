new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        assignments:[]
    },
    mounted() {
         $(".summernote").summernote({
             height: 190,
             minHeight: null,
             maxHeight: null,
             focus: !1
         }),
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
