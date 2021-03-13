require('./bootstrap');
window.Vue = require('vue').default;

import VueRouter from "vue-router";
import VueAxios from "vue-axios";
import axios from "axios";
Vue.prototype.$http = axios;
Vue.use(VueRouter);

import App from './App.vue';

import Home from '../js/components/Home'
import ContactList from '../js/components/ContactList'


Vue.use("VueAxios", axios);

const routes = [
    {
        name: '/',
        path: '/',
        component: Home
    }, {
        name: '/contacts',
        path: '/contacts',
        component: ContactList
    }
];

const router = new VueRouter({mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({router},App)).$mount('#app');


