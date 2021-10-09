Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        student: {}
    },
    mounted() {
        this.get_student();
    },
    methods: {
        get_student() {
            swal.fire('Please wait ...');
            swal.showLoading();

            axios.get(`${url.get_single_student_by_id + id}`, config)
                .then((response) => {
                    console.log(response);
                    this.student = response.data.student;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`something went wrong ${error.response.status}`);
                })
                .then(() => {
                    swal.close();
                });
        }
    }
})
