Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: true,

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
    },
});
