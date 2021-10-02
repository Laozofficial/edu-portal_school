Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        institutions: [],
        selected_institution: '',

        errors: [],
        errors_switch: false,

        currencies: [],
        countries: [],
        states: [],
        languages: [],

        selected_currency: '',
        selected_country: '',
        selected_state: '',
        selected_language: '',

        first_name: 'Emma',
        middle_name: 'Nwankwo',
        last_name: 'Ikay',
        gender: 'male',
        date_of_birth: '',
        religion: 'islam',
        present_address: 'Military cantonment',
        city: 'ikeja',
        avatar: '',
        email: '',


    },
    mounted() {
        this.get_schools();
        this.get_details_for_registration();
    },
     watch: {
         errors_switch: function () {
             setTimeout(() => {
                 this.errors_switch = false;
             }, 15000);
         }
     },
    methods: {
        get_schools() {
            axios.get(`${url.get_all_schools}`, config)
                .then((response) => {
                    console.log(response);
                    this.institutions = response.data.institutions;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`something went wrong ${error.response.status}`);
                })
                .then(() => {
                    this.showContent();
                });
            },
        showContent() {
            this.loading = false;
            this.content = true;
        },
        get_details_for_registration() {
            axios.get(`${url.get_details_for_registration}`, config)
                .then((response) => {
                    console.log(response);
                    this.countries = response.data.countries;
                    this.currencies = response.data.currencies;
                    this.states = response.data.states;
                    this.languages = response.data.languages;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error(`something went wrong ${error.response.status}`);
                });
        },
        onPassportChange(event) {
            this.avatar = event.target.files[0];
        },
        save_student() {

            if (this.selected_institution == '') {
                swal('Oops', 'Please select an institution', 'error');
            } else {
                swal.fire({
                    text: 'Please wait...',
                    allowOutsideClick: false
                });
                swal.showLoading();

                let fd = new FormData;
                fd.append('first_name', this.first_name);
                fd.append('last_name', this.last_name);
                fd.append('middle_name', this.middle_name);
                fd.append('gender', this.gender);
                fd.append('religion', this.religion);
                fd.append('state', this.selected_state);
                fd.append('country', this.selected_country);
                fd.append('city', this.city);
                fd.append('avatar', this.avatar);
                fd.append('email', this.email);
                fd.append('date_of_birth', this.date_of_birth);
                fd.append('present_address', this.present_address);

                axios.post(`${url.save_student + this.selected_institution}`, fd, config)
                    .then((response) => {
                        console.log(response);
                        swal.close();
                        swal('Weldon', response.data.success, 'success');
                    })
                    .catch((error) => {
                        console.log(error);
                        this.errors = error.response.data.errors;
                        this.errors_switch = true;
                        swal.close();
                        toastr.error(`something went wrong ${error.response.status}`);
                    });
            }
        },
    },
})
