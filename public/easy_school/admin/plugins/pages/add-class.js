Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#app',
    data: {
        loading: true,
        content: false,

        institutions: [],
        selected_institution: '',

    },
    mounted() {

    },
    methods: {
        get_school_info() {

        },
        showContent() {
            this.loading = false;
            this.content = true;
        }
    },
})
