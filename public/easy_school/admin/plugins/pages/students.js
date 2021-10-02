Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        institutions: [],
        selected_institution: '',

        students: [],

    },
    mounted() {

    },
    methods: {
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
        showContent() {
            this.loading = false;
            this.content = true;
        }
    },
})
