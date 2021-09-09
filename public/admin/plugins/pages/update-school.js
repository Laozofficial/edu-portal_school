Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        institution: {},
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
    },
    mounted() {
        this.get_details_for_registration();
    },
    watch: {
        errors_switch: function () {
            setTimeout(() => {
                this.errors_switch = false;
            }, 10000);
        }
    },
    methods: {
        get_details_for_registration() {
            axios.get(`${url.get_details_for_registration}`, config)
                .then((response) => {
                    console.log(response);
                    this.countries = response.data.countries;
                    this.currencies = response.data.currencies;
                    this.states = response.data.states;
                    this.languages = response.data.languages;
                    this.get_school_details();
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error('something went wrong');
                })
        },
        get_school_details() {
            axios.get(`${url.get_school_details + id}`, config)
                .then((response) => {
                    console.log(response);
                    this.institution = response.data.institution;
                    this.selected_country = this.institution.country.name;
                    this.selected_currency = this.institution.currency.currency_name;
                    this.selected_language = this.institution.language.name;
                    this.selected_state = this.institution.state.name;
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error('something went wrong');
                })
                .then(() => {
                    this.showContent();
                });
        },
        update_institution() {
            if (this.name == '' || this.email == '' || this.phone == '' || this.address == '' ) {
                swal.fire('Oops..', 'some fields were left unattended', 'error');
            } else {
                swal.fire({
                    text: 'Please wait...',
                    allowOutsideClick: false
                });
                swal.showLoading();

                let fd = new FormData;
                fd.append('email', this.institution.email);
                fd.append('prefix_code', this.institution.prefix_code);
                fd.append('address', this.institution.address);
                fd.append('website', this.institution.website);

                if (Number.isInteger(this.selected_currency)) {
                    fd.append('currency_id', this.selected_currency);
                }
                if (Number.isInteger(this.selected_language)) {
                    fd.append('language_id', this.selected_language);
                }

                fd.append('signature', this.signature);
                fd.append('phone', this.institution.phone);

                axios.post(`${url.update_institution + id}`, fd, config)
                    .then((response) => {
                        console.log(response);
                        swal.close();
                        swal.fire('weldon', response.data.success, 'success');
                        this.get_school_details();
                    })
                    .catch((error) => {
                        console.log(error);
                        toastr.error('something went wrong');
                    })
            }
        },

        onSignatureChanged(event) {
            this.signature = event.target.files[0];
        },
        showContent() {
            this.loading = false;
            this.content = true;
        },
    },
})
