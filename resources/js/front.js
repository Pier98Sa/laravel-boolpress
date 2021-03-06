window.Vue = require('vue'); //richiamo vue
window.axios = require('axios'); //richiamo axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Vue from 'vue';
import App from './views/App';

//importo Vue Router
import router from './router';

const app = new Vue({
    el: '#root',
    render: h => h(App),
    router
});