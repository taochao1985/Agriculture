require('./bootstrap');

window.Vue = require('vue');
import Vuetify from 'vuetify';
import router from './router';
import { sync } from 'vuex-router-sync';
import store from './store/store';
import 'vuetify/dist/vuetify.min.css';
import VeeValidate from 'vee-validate';

Vue.component('alert-component', require('./components/common/Alert.vue'));
Vue.component('admin-dashboard', require('./components/AdminDashboard.vue'));
Vue.component('admin-login', require('./components/Login.vue'));

Vue.use(Vuetify);
Vue.use(VeeValidate);

const app = new Vue({
    el: '#app',
    router,
    store
});
