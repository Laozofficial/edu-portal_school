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

        first_name: '',
        middle_name: '',
        last_name: '',
        gender: '',
        date_of_birth: '',
        religion: '',
        present_address: '',
        city: '',


    },
    mounted() {
        this.get_schools();
        this.get_details_for_registration();
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
                    toastr.error('something went wrong');
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
                    toastr.error('something went wrong');
                });
        },

    },
})
