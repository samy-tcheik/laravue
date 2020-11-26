/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import VueRouter from 'vue-router';
import Vuetify from 'vuetify';

import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)

const vuetify = new Vuetify()
import VuetifyConfirm from 'vuetify-confirm'
Vue.use(VuetifyConfirm, { vuetify })

window.Vue = require('vue');

Vue.use(VueRouter);
Vue.use(Vuetify);

import Home from './components/HomeComponent.vue';
import UserManager from './components/users/UserManagerComponent.vue';
import EditUserComponent from './components/users/EditUserComponent.vue';
import AddUserComponent from './components/users/AddUserComponent';

import Vue from 'vue'


const routes = [
    { path: '/home', component: Home},
    { path: '/user_manager', name: 'user_manager', component: UserManager},
    { path: '/user_manager/edit/:user_id', name: 'user_edit', component: EditUserComponent},
    { path: '/add_user', name: 'user_add', component: AddUserComponent}
]

const router = new VueRouter({
    routes: routes
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 
const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    router,
    
});
