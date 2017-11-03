import Vue from 'vue';

import Axios from 'axios';

import VuewRouter from 'vue-router';

import Form from './utilities/Form';

import Coleccion from './utilities/Coleccion';

import Utilidades from './utilities/Utilidades';

import Constants from './utilities/Constats';

import VModal from 'vue-js-modal';

import Notifications from 'vue-notification';

import Conexion from './models/Conexion';

import Moment from 'vue-moment';




//--Modelos

import Notificacion from './models/Notificacion';
import Comedor from './models/Comedor';
import Comensal from './models/Comensal';
import TipoComida from './models/TipoComida';
import Dia from './models/Dia';
import Comida from './models/Comida';
import Direccion from './models/Direccion';
import Pais from './models/Pais';


import Lang from 'lang.js';

window.mensajes = require('./text/mensajes.json');

window.Utilidades = Utilidades;
window.Coleccion = Coleccion;
window.Constants = Constants;
window.Conexion = Conexion;

//Models--
window.Notificacion = Notificacion;
window.Comedor = Comedor;
window.Comensal = Comensal;
window.TipoComida = TipoComida;
window.Dia = Dia;
window.Comida = Comida;
window.Direccion = Direccion;
window.Pais = Pais;


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
require('moment/locale/es');

Vue.use(VModal, { dialog: true });
Vue.use(Notifications);
Vue.use(Moment);

Vue.component('titulo',require('./components/oters/Titulo.vue'));
Vue.component('modal',require('./components/oters/Modal.vue'));
Vue.component('modal-delet',require('./components/oters/ModalDelet.vue'));
Vue.component('search',require('./components/oters/Search.vue'));
Vue.component('data-viewer',require('./utilities/DataViewer.vue'));
Vue.component('tabla',require('./utilities/Tabla.vue'));
Vue.component('select-auto',require('./utilities/Select.vue'));
Vue.component('comensal-index',require('./components/comensal/Index.vue'));
Vue.component('comedor-index',require('./components/comedor/Index.vue'));
Vue.component('loading',require('./components/oters/Loading.vue'));

Vue.component('datepicker',require('vuejs-datepicker'));




Vue.filter('key',function (value) {
  return mensajes.keys[value]? mensajes.keys[value] : value;
});
Vue.filter('tipoComida',function (value) {
  if(value.indexOf('DESAYUNO') > -1){
     return 'el '  + value;
  }else if (value.toUpperCase().indexOf('ALMUERZO') > -1){
    return 'el '  + value;
  }else if (value.toUpperCase().indexOf('MERIENDA') > -1){
    return 'la '  + value;
  }else if (value.toUpperCase().indexOf('CENA') > -1){
    return 'la '  + value;
  }
  return value;
});
Vue.filter('cLength', function (result, key) {
  this.$set(key, result.length)
});
Vue.filter('path',function (value) {
  return PATH + value;
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
    },
    get(list,keys){
      var ret =  _.pick(list,function (value, key, object) {
        var val = _.values(keys);
        return _.contains(val,key);
      });
      return ret;
    },
    hasRoute: function (partial) {
      return (window.location.href.indexOf(partial) > -1)
    }
  }
});

//Vue.component('register-form', require('./components/auth/RegisterForm.vue'))
//Vue.component('login-form', require('./components/auth/LoginForm.vue'))
//Vue.component('email-reset-password-form', require('./components/auth/EmailResetPasswordForm.vue'))
//Vue.component('reset-password-form', require('./components/auth/ResetPasswordForm.vue'))
