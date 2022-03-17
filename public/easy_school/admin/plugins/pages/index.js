new Vue({
    el: '#app',
    data: {
        students_count: '',
        school_count: '',
        teachers_count: '',

    },
    mounted() {

    },
    methods: {
        get_dashboard_details() {
            swal.fire('Welcome back..');
            swal.showLoading();

            axios.get('')
        }
    },
})
