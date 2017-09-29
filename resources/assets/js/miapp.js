
require('./bootstrap');

import router from './routes';


window.vm = new Vue({
    data:{
        app:{}
    },
    router : router

});

vm.$mount('#app');;

