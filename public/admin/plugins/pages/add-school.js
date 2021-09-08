Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: true,

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

        name: '',
        prefix: '',
        address: '',
        phone: '',
        email: '',
        website: '',
        signature: '',
        logo: '',



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
                })
                .catch((error) => {
                    console.log(error);
                    toastr.error('something went wrong');
                })
        },
        onLogoChanged (event) {
            this.logo = event.target.files[0];
        },
        onSignatureChanged(event) {
            this.signature = event.target.files[0];
        },
        add_institution() {
            if (this.name == '' || this.email == '' || this.phone == '' || this.logo == '' || this.selected_country == '' || this.selected_currency == '' || this.selected_language == '' || this.selected_state == '') {
                swal.fire('Oops..', 'some fields were left unattended', 'error');
            } else {
                this.save_institution();
            }
        },
        save_institution() {
            swal.fire({
                text: 'Please wait...',
                allowOutsideClick: false
            });
            swal.showLoading();

            let fd = new FormData;
            fd.append('name', this.name);
            fd.append('email', this.email);
            fd.append('prefix', this.prefix);
            fd.append('address', this.address);
            fd.append('website', this.website);
            fd.append('country_id', this.selected_country);
            fd.append('currency_id', this.selected_currency);
            fd.append('language_id', this.selected_language);
            fd.append('state_id', this.selected_state);
            fd.append('logo', this.logo);
            fd.append('signature', this.signature);
            fd.append('phone', this.phone);

            axios.post(`${url.save_institution}`, fd, config)
                .then((response) => {
                    console.log(response);
                    swal.close();
                    swal.fire('Weldon', response.data.success, 'error');
                    setTimeout(() => {
                        window.location.href = '/dashboard/admin/index';
                    },2000);
                })
                .catch((error) => {
                    console.log(error);
                    this.errors = error.response.data.errors;
                    this.errors_switch = true;
                    swal.close();
                    toastr.error('something went wrong');
                });
        },
    },
});
