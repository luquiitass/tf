import Vue from 'vue';

import Axios from 'axios';

import VuewRouter from 'vue-router';


window.Vue = Vue;

Vue.use(VuewRouter);

window.axios = Axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue')

// Use trans function in Vue (equivalent to trans() Laravel Translations helper). See htmlheader.balde.php partial.
Vue.prototype.trans = (key) => {
  return _.get(window.trans, key, key)
}

// Laravel AdminLTE vue components

Vue.component('titulo',require('./components/Titulo.vue'));


//Vue.component('register-form', require('./components/auth/RegisterForm.vue'))
//Vue.component('login-form', require('./components/auth/LoginForm.vue'))
//Vue.component('email-reset-password-form', require('./components/auth/EmailResetPasswordForm.vue'))
//Vue.component('reset-password-form', require('./components/auth/ResetPasswordForm.vue'))
