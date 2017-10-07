import Vue from 'vue';

import Axios from 'axios';

import VuewRouter from 'vue-router';

import Form from './utilities/Form';

import Utilidades from './utilities/Utilidades';

import VModal from 'vue-js-modal';

import Notifications from 'vue-notification';

import Lang from 'lang.js';

window.mensajes = require('./text/mensajes.json');

window.Utilidades = Utilidades;

window.Vue = Vue;

Vue.use(VuewRouter);

window.axios = Axios;

window.Form = Form;

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

Vue.use(VModal, { dialog: true });
Vue.use(Notifications);

Vue.component('titulo',require('./components/oters/Titulo.vue'));
Vue.component('data-viewer',require('./utilities/DataViewer.vue'));
Vue.component('tabla',require('./utilities/Tabla.vue'));
Vue.component('select-auto',require('./utilities/Select.vue'));


Vue.filter('key',function (value) {
  return mensajes.keys[value]? mensajes.keys[value] : value;
});


Vue.mixin({
  methods: {
    getItems: function (list) {
      var ob =[];
      for(var key in list){
          if(!Array.isArray(list[key])){
            ob[key]=list[key]
          }
      }
      return ob;
    }
  }
});


//Vue.component('register-form', require('./components/auth/RegisterForm.vue'))
//Vue.component('login-form', require('./components/auth/LoginForm.vue'))
//Vue.component('email-reset-password-form', require('./components/auth/EmailResetPasswordForm.vue'))
//Vue.component('reset-password-form', require('./components/auth/ResetPasswordForm.vue'))
