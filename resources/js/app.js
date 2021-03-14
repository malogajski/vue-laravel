import Vue from "vue";
import Home from '../js/components/Home';
import ContactList from '../js/components/ContactList';
import AddContact from '../js/components/AddContact';
import EditContact from "./components/EditContact";

// sweet alert 2
import VueSweetalert2 from "vue-sweetalert2";
window.Swal = require('sweetalert2');
Vue.use(VueSweetalert2);

import utils from './helpers/utilitis';
Vue.prototype.$utils = utils;

require('./bootstrap');
window.Vue = require('vue').default;

import VueRouter from "vue-router";
import VueAxios from "vue-axios";
import axios from "axios";
Vue.prototype.$http = axios;
Vue.use(VueRouter);

import App from './App.vue';



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
    }, {
        name: '/add_contact',
        path: '/add_contact',
        component: AddContact
    }, {
        name: '/get_contact',
        path: '/get_contact/edit/:id?',
        component: EditContact
    }
];

const router = new VueRouter({mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({router},App)).$mount('#app');


