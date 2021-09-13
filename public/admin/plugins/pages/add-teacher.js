Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        institutions: [],
        selected_institution: '',

        states: [],
        selected_state: '',

        countries: [],
        selected_country: '',

        first_name: '',
        last_name: '',
        middle_name: '',
        email: '',
        phone: '',
        date_of_birth: '',
        gender: '',
        religion: '',
        qualification: '',
        present_address: '',
        avatar: '',

    },
    mounted() {
        this.get_details_for_registration();
        this.get_schools();
    },
    methods: {
        get_details_for_registration() {
            axios.get(`${url.get_details_for_registration}`, config)
                .then((response) => {
                    console.log(response);
                    this.countries = response.data.countries;
                    // this.currencies = response.data.currencies;
                    this.states = response.data.states;
                    // this.languages = response.data.languages;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error('something went wrong');
                })
        },
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
        validate() {
            if (this.selected_institution == '' || this.selected_country == '' || this.selected_state == '' || this.first_name == '' || this.last_name == '' || this.middle_name == '' || this.phone == '' || this.date_of_birth == '' || this.gender == '' || this.religion == '' || this.qualification == '' || this.present_address == '') {
                swal.fire('Oops..', 'some fields are missing', 'error');
            }else {
                this.save_teacher();
            }
        },
        save_teacher() {
            swal.fire({
                text: 'Please wait...',
                allowOutsideClick: false
            });
            swal.showLoading();

            let fd = new FormData;
            fd.append('country_id', this.selected_country);
            fd.append('institution_id', this.selected_institution);
            fd.append('state_id', this.selected_state);
            fd.append('first_name', this.first_name);
            fd.append('last_name', this.last_name);
            fd.append('middle_name', this.middle_name);
            fd.append('phone', this.phone);
            fd.append('date_of_birth', this.date_of_birth);
            fd.append('gender', this.gender);
            fd.append('present_address', this.present_address);
            fd.append('religion', this.religion);
            fd.append('qualification', this.qualification);
            fd.append('image', this.avatar);

            axios.post()
        },
        onPassportChange(event) {
            this.avatar = event.target.files[0];
        },
        showContent() {
            this.loading = false;
            this.content = true;
        },

    },
});
