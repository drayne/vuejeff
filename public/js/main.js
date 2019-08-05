new Vue({
    el: '#app',

    data: {
        skills: []
    },

    created() {
        axios.get('/vue').then(response => this.skills = response.data);
    }
});