Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        attendance_setups: {},
        selected_attendance_setup: '',

        classes: [],
        selected_class: '',

        students: [],
        selected_student: '',

        days: 0,

        student: {},

        loading_student: false,
        page: 1,
    },
    mounted() {
        this.get_classes();
        this.get_attendance_setup();
    },
    methods: {
        get_classes() {
                axios.get(`${url.teacher_get_classes}`, config)
                    .then((response) => {
                        console.log(response);
                        this.classes = response.data.levels;
                    })
                    .catch((error) => {
                        console.log(error);
                        toastr.error(`something went wrong ${error.response.status}`);
                    })
                    .then(() => {
                        this.showContent();
                    });
            },
            get_students() {
                this.loading_students = true;
                swal.fire('Please wait.....');
                swal.showLoading();

                axios.get(`${url.teacher_get_students_from_classes + this.selected_class + '?page=' + this.page}`, config)
                    .then((response) => {
                        console.log(response);
                        this.students = response.data.students;
                    })
                    .catch((error) => {
                        console.log(error);
                        toastr.error(`something went wrong ${error.response.status}`);
                    })
                    .then(() => {
                        swal.close();
                        this.loading_students = false;
                    });
            },
            pageChange(page) {
                if (this.page != page && page != 0) {
                    this.page = page;
                    this.get_students();
                }
            },
            showContent() {
                this.loading = false;
                this.content = true;
        },
        get_attendance_setup() {
            axios.get(`${url.teacher_get_attendance_setup}`, config)
                .then((response) => {
                    console.log(response);
                    this.attendance_setups = response.data.attendance;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error('something went wrong');
                });
        },
        add_attendance(student) {
            this.student = student;
        },
        save_attendance() {
            if(this.selected_class == '' || this.student.id == '' || this.days == '' || this.attendance_setups.id == '') {
                toastr.error('Please fill all the fields');
                return;
            }

            swal.fire('saving attendance..');
            swal.showLoading();

            let fd = new FormData;
            fd.append('class', this.selected_class);
            fd.append('student', this.student.id);
            fd.append('days', this.days);
            fd.append('attendance_setup', this.attendance_setups.id);

            axios.post(`${url.teacher_save_attendance_setup}`, fd, config)
                .then((response) => {
                    console.log(response);
                    swal.fire('success', response.data.success, 'error');
                })
                .catch((error) => {
                    console.log(error);
                    if (error.response.data.error) {
                        swal.fire('error', error.response.data.error, 'error');
                        return;
                    }
                    toastr.error('something went wrong');
                })
                .then(() => {
                setTimeout(() => {
                    swal.close();
                }, 3500);
            })
        }
    }
});
