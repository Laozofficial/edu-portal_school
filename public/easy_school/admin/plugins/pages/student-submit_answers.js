new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        assignment: assignment,

        solution_upload: '',
        solution_written: '',
    },
    mounted() {
        showContentView();
        $(".summernote").summernote({
            height: 190,
            minHeight: null,
            maxHeight: null,
            focus: !1
        });
    },
    methods: {
        onAssignmentChange(event) {
            this.solution_upload = event.target.files[0];
        },
        submit_assignment() {
            this.solution_written = $('.summernote').val();
            if (this.solution_upload !== '' && this.solution_written !== '') {
                swal.fire('Oops', 'You can only Use one of the submit Methods', 'error');
                return;
            }

        },

    },
});
