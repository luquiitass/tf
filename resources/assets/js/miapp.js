
require('./bootstrap');

import router from './routes';


window.vm = new Vue({
    data:{
        app:{},
        path:PATH,
    },
    router : router,
    created(){
        this.getUser();
    },
    methods: {
        getUser(){
            var self = this;
            axios.get(PATH + 'getUser')
                .then(response=> {
                    self.app.usuario = response.data;
                })
                .catch(error=> {
                    console.log(error);
                });

        }
    }

});

vm.$mount('#app');;

